<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(): View
    {
        $pageMeta = [
            'title' => 'Pengaturan Admin',
            'subtitle' => 'Kelola pengaturan sistem FundUnity',
        ];

        $user = Auth::user();
        $settings = SiteSetting::query()->pluck('value', 'key');

        $profile = [
            'displayName' => $user?->name,
            'email' => $user?->email,
            'photoUrl' => $settings->get('admin_profile_photo'),
        ];

        $identity = [
            'orgName' => $settings->get('site_name') ?: 'Komunitas Ruang Berbagi',
            'shortName' => $settings->get('site_short_name') ?: 'FundUnity',
            'tagline' => $settings->get('identity_tagline') ?: 'Bangun komunitas, kelola donasi.',
            'email' => $settings->get('email') ?: ($user?->email ?: ''),
            'phone' => $settings->get('phone') ?: '',
            'instagramUrl' => $settings->get('instagram_url') ?: '',
            'address' => $settings->get('address') ?: '',
            'logoUrl' => $settings->get('site_logo') ?: '',
        ];

        $payment = [
            'bankName' => $settings->get('payment_bank_name') ?: '',
            'bankAccount' => $settings->get('payment_bank_account') ?: '',
            'bankHolder' => $settings->get('payment_bank_holder') ?: '',
            'qrisUrl' => $settings->get('payment_qris_url') ?: '',
            'qrisEnabled' => $settings->get('payment_qris_enabled') === '1',
        ];

        $seo = [
            'metaDescription' => $settings->get('seo_meta_description') ?: '',
            'footerCopyright' => $settings->get('footer_copyright') ?: '',
            'maintenanceMode' => $settings->get('maintenance_mode') === '1',
        ];

        return view('admin.settings', compact('pageMeta', 'user', 'profile', 'identity', 'payment', 'seo'))
            ->with('sidebarWidth', '256px');
    }

    public function updateProfile(Request $request): JsonResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'displayName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'photo_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $user->update([
            'name' => $validated['displayName'],
            'email' => $validated['email'],
        ]);

        $currentPhoto = SiteSetting::query()->where('key', 'admin_profile_photo')->value('value');
        $newPhoto = $this->resolveImageValue($request, 'photo_file', null, $currentPhoto, 'settings/admin-profile');

        if ($newPhoto !== $currentPhoto) {
            $this->deleteStoredImageIfNeeded($currentPhoto);
        }

        if ($newPhoto) {
            $this->upsertSetting('admin_profile_photo', $newPhoto, 'image', 'admin', 'Admin Profile Photo');
        }

        return response()->json([
            'message' => 'Profil admin berhasil diperbarui.',
            'data' => [
                'displayName' => $user->name,
                'email' => $user->email,
                'photoUrl' => $newPhoto,
            ],
        ]);
    }

    public function updateIdentity(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'orgName' => ['required', 'string', 'max:255'],
            'shortName' => ['nullable', 'string', 'max:100'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:100'],
            'instagramUrl' => ['nullable', 'url', 'max:500'],
            'address' => ['nullable', 'string', 'max:255'],
            'logoUrl' => ['nullable', 'url', 'max:500'],
            'logo_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $currentLogo = SiteSetting::query()->where('key', 'site_logo')->value('value');
        $newLogo = $this->resolveImageValue($request, 'logo_file', 'logoUrl', $currentLogo, 'settings/site-logo');

        if ($newLogo !== $currentLogo) {
            $this->deleteStoredImageIfNeeded($currentLogo);
        }

        $this->upsertSetting('site_name', $validated['orgName'], 'text', 'general', 'Site Name');
        $this->upsertSetting('site_short_name', $this->nullableString($validated['shortName'] ?? null), 'text', 'general', 'Site Short Name');
        $this->upsertSetting('identity_tagline', $this->nullableString($validated['tagline'] ?? null), 'text', 'general', 'Identity Tagline');
        $this->upsertSetting('email', $validated['email'], 'text', 'general', 'Email');
        $this->upsertSetting('phone', $this->nullableString($validated['phone'] ?? null), 'text', 'general', 'Phone');
        $this->upsertSetting('instagram_url', $this->nullableString($validated['instagramUrl'] ?? null), 'url', 'social', 'Instagram URL');
        $this->upsertSetting('address', $this->nullableString($validated['address'] ?? null), 'text', 'general', 'Address');
        $this->upsertSetting('site_logo', $this->nullableString($newLogo), 'image', 'general', 'Site Logo');

        return response()->json([
            'message' => 'Identitas website berhasil disimpan.',
            'data' => [
                'orgName' => $validated['orgName'],
                'shortName' => $validated['shortName'] ?? null,
                'tagline' => $validated['tagline'] ?? null,
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'instagramUrl' => $validated['instagramUrl'] ?? null,
                'address' => $validated['address'] ?? null,
                'logoUrl' => $newLogo,
            ],
        ]);
    }

    public function updatePayment(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'bankName' => ['required', 'string', 'max:100'],
            'bankAccount' => ['required', 'string', 'max:100'],
            'bankHolder' => ['required', 'string', 'max:200'],
            'qrisEnabled' => ['nullable', 'boolean'],
            'qrisUrl' => ['nullable', 'url', 'max:500'],
            'qris_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $currentQris = SiteSetting::query()->where('key', 'payment_qris_url')->value('value');
        $newQris = $this->resolveImageValue($request, 'qris_file', 'qrisUrl', $currentQris, 'settings/payment-qris');

        if ($newQris !== $currentQris) {
            $this->deleteStoredImageIfNeeded($currentQris);
        }

        $this->upsertSetting('payment_bank_name', $validated['bankName'], 'text', 'payment', 'Payment Bank Name');
        $this->upsertSetting('payment_bank_account', $validated['bankAccount'], 'text', 'payment', 'Payment Bank Account');
        $this->upsertSetting('payment_bank_holder', $validated['bankHolder'], 'text', 'payment', 'Payment Bank Holder');
        $this->upsertSetting('payment_qris_url', $this->nullableString($newQris), 'image', 'payment', 'Payment QRIS URL');
        $this->upsertSetting('payment_qris_enabled', $request->boolean('qrisEnabled') ? '1' : '0', 'text', 'payment', 'Payment QRIS Enabled');

        return response()->json([
            'message' => 'Konfigurasi pembayaran berhasil disimpan.',
            'data' => [
                'bankName' => $validated['bankName'],
                'bankAccount' => $validated['bankAccount'],
                'bankHolder' => $validated['bankHolder'],
                'qrisUrl' => $newQris,
                'qrisEnabled' => $request->boolean('qrisEnabled'),
            ],
        ]);
    }

    public function updateSeo(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'metaDescription' => ['nullable', 'string', 'max:1000'],
            'footerCopyright' => ['nullable', 'string', 'max:255'],
            'maintenanceMode' => ['nullable', 'boolean'],
        ]);

        $this->upsertSetting('seo_meta_description', $this->nullableString($validated['metaDescription'] ?? null), 'textarea', 'seo', 'SEO Meta Description');
        $this->upsertSetting('footer_copyright', $this->nullableString($validated['footerCopyright'] ?? null), 'text', 'general', 'Footer Copyright');
        $this->upsertSetting('maintenance_mode', $request->boolean('maintenanceMode') ? '1' : '0', 'text', 'general', 'Maintenance Mode');

        return response()->json([
            'message' => 'Pengaturan SEO dan global berhasil disimpan.',
        ]);
    }

    public function updateSecurity(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = $request->user();
        $user->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        return response()->json([
            'message' => 'Kata sandi berhasil diperbarui.',
        ]);
    }

    private function resolveImageValue(Request $request, string $fileField, ?string $urlField, ?string $currentValue, string $directory): ?string
    {
        if ($request->hasFile($fileField)) {
            $path = $request->file($fileField)->store($directory, 'public');

            return Storage::url($path);
        }

        if ($urlField && $request->filled($urlField)) {
            return $request->string($urlField)->toString();
        }

        return $currentValue;
    }

    private function upsertSetting(string $key, ?string $value, string $type, string $group, string $label): void
    {
        SiteSetting::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'group' => $group,
                'label' => $label,
            ]
        );
    }

    private function nullableString(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $trimmed = trim($value);

        return $trimmed === '' ? null : $trimmed;
    }

    private function deleteStoredImageIfNeeded(?string $imagePath): void
    {
        if (! $imagePath || ! Str::startsWith($imagePath, '/storage/')) {
            return;
        }

        Storage::disk('public')->delete(Str::after($imagePath, '/storage/'));
    }
}
