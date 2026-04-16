<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IdentityController extends Controller
{
    public function update(Request $request): JsonResponse
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
        ]);

        $this->upsertSetting('site_name', $validated['orgName'], 'text', 'general', 'Site Name');
        $this->upsertSetting('site_short_name', $this->nullableString($validated['shortName'] ?? null), 'text', 'general', 'Site Short Name');
        $this->upsertSetting('identity_tagline', $this->nullableString($validated['tagline'] ?? null), 'text', 'general', 'Identity Tagline');
        $this->upsertSetting('email', $validated['email'], 'text', 'general', 'Email');
        $this->upsertSetting('phone', $this->nullableString($validated['phone'] ?? null), 'text', 'general', 'Phone');
        $this->upsertSetting('instagram_url', $this->nullableString($validated['instagramUrl'] ?? null), 'url', 'social', 'Instagram URL');
        $this->upsertSetting('address', $this->nullableString($validated['address'] ?? null), 'text', 'general', 'Address');
        $this->upsertSetting('site_logo', $this->nullableString($validated['logoUrl'] ?? null), 'image', 'general', 'Site Logo');

        return response()->json([
            'message' => 'Identitas website berhasil diperbarui.',
            'data' => [
                'orgName' => $validated['orgName'],
                'shortName' => $validated['shortName'] ?? null,
                'tagline' => $validated['tagline'] ?? null,
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'instagramUrl' => $validated['instagramUrl'] ?? null,
                'address' => $validated['address'] ?? null,
                'logoUrl' => $validated['logoUrl'] ?? null,
            ],
        ]);
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
}
