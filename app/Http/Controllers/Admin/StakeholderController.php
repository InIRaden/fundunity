<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Volunteer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StakeholderController extends Controller
{
    public function store(Request $request, string $type): JsonResponse
    {
        return match ($type) {
            'donatur' => $this->storeDonor($request),
            'penerima' => $this->storeBeneficiary($request),
            'relawan' => $this->storeVolunteer($request),
            default => response()->json(['message' => 'Tipe stakeholder tidak dikenali.'], 404),
        };
    }

    public function update(Request $request, string $type, int $id): JsonResponse
    {
        return match ($type) {
            'donatur' => $this->updateDonor($request, $id),
            'penerima' => $this->updateBeneficiary($request, $id),
            'relawan' => $this->updateVolunteer($request, $id),
            default => response()->json(['message' => 'Tipe stakeholder tidak dikenali.'], 404),
        };
    }

    public function destroy(string $type, int $id): JsonResponse
    {
        return match ($type) {
            'donatur' => $this->destroyDonor($id),
            'penerima' => $this->destroyBeneficiary($id),
            'relawan' => $this->destroyVolunteer($id),
            default => response()->json(['message' => 'Tipe stakeholder tidak dikenali.'], 404),
        };
    }

    private function storeDonor(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:200'],
            'email' => ['nullable', 'email', 'max:255'],
            'totalDonasi' => ['nullable', 'integer', 'min:0'],
            'lastDonasi' => ['nullable', 'date'],
            'campaign_id' => ['nullable', 'integer', 'exists:campaigns,id'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $donor = Donor::create([
            'name' => $validated['nama'],
            'email' => $validated['email'] ?? null,
            'total_donation' => $validated['totalDonasi'] ?? 0,
            'last_donation' => $validated['lastDonasi'] ?? now()->toDateString(),
            'is_active' => true,
        ]);

        // Create a donation record for this manual entry
        $donation = Donation::create([
            'transaction_id' => 'MAN-' . strtoupper(Str::random(10)),
            'campaign_id' => $validated['campaign_id'] ?? null,
            'donor_id' => $donor->id,
            'amount' => $validated['totalDonasi'] ?? 0,
            'status' => 'success',
            'payment_method' => 'manual',
            'prayer' => $validated['notes'] ?? null,
            'is_anonymous' => false,
        ]);

        // Increment campaign collected amount
        if (! empty($validated['campaign_id'])) {
            $campaign = Campaign::find($validated['campaign_id']);
            if ($campaign) {
                $campaign->increment('collected', (int) ($validated['totalDonasi'] ?? 0));
            }
        }

        return response()->json([
            'message' => 'Data donasi manual berhasil ditambahkan.',
            'data' => [
                'id' => $donation->id,
                'nama' => $donor->name,
                'lastDonasi' => $donation->created_at->format('Y-m-d'),
            ],
        ], 201);
    }

    private function updateDonor(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:200'],
            'email' => ['nullable', 'email', 'max:255'],
            'totalDonasi' => ['nullable', 'integer', 'min:0'],
            'lastDonasi' => ['nullable', 'date'],
        ]);

        $donor = Donor::findOrFail($id);
        $donor->update([
            'name' => $validated['nama'],
            'email' => $validated['email'] ?? null,
            'total_donation' => $validated['totalDonasi'] ?? 0,
            'last_donation' => $validated['lastDonasi'] ?? null,
        ]);

        return response()->json([
            'message' => 'Data donatur berhasil diperbarui.',
            'data' => $this->transformDonor($donor->fresh()),
        ]);
    }

    private function destroyDonor(int $id): JsonResponse
    {
        Donor::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Data donatur berhasil dihapus.',
        ]);
    }

    private function storeBeneficiary(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:200'],
            'program' => ['required', 'string', 'max:200'],
            'lokasi' => ['nullable', 'string', 'max:200'],
            'nilai' => ['nullable', 'integer', 'min:0'],
        ]);

        $beneficiary = Beneficiary::create([
            'name' => $validated['nama'],
            'program_name' => $validated['program'],
            'location' => $validated['lokasi'] ?? null,
            'assistance_value' => $validated['nilai'] ?? 0,
            'is_active' => true,
        ]);

        return response()->json([
            'message' => 'Data penerima bantuan berhasil ditambahkan.',
            'data' => $this->transformBeneficiary($beneficiary),
        ], 201);
    }

    private function updateBeneficiary(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:200'],
            'program' => ['required', 'string', 'max:200'],
            'lokasi' => ['nullable', 'string', 'max:200'],
            'nilai' => ['nullable', 'integer', 'min:0'],
        ]);

        $beneficiary = Beneficiary::findOrFail($id);
        $beneficiary->update([
            'name' => $validated['nama'],
            'program_name' => $validated['program'],
            'location' => $validated['lokasi'] ?? null,
            'assistance_value' => $validated['nilai'] ?? 0,
        ]);

        return response()->json([
            'message' => 'Data penerima bantuan berhasil diperbarui.',
            'data' => $this->transformBeneficiary($beneficiary->fresh()),
        ]);
    }

    private function destroyBeneficiary(int $id): JsonResponse
    {
        Beneficiary::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Data penerima bantuan berhasil dihapus.',
        ]);
    }

    private function storeVolunteer(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:200'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'kategori' => ['nullable', 'string', 'max:150'],
            'date' => ['nullable', 'date'],
            'isVerified' => ['nullable', 'boolean'],
        ]);

        $volunteer = Volunteer::create([
            'name' => $validated['nama'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'category' => $validated['kategori'] ?? null,
            'registered_at' => $validated['date'] ?? null,
            'is_verified' => $validated['isVerified'] ?? true,
            'is_active' => true,
        ]);

        return response()->json([
            'message' => 'Data relawan berhasil ditambahkan.',
            'data' => $this->transformVolunteer($volunteer),
        ], 201);
    }

    private function updateVolunteer(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:200'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'kategori' => ['nullable', 'string', 'max:150'],
            'date' => ['nullable', 'date'],
            'isVerified' => ['nullable', 'boolean'],
        ]);

        $volunteer = Volunteer::findOrFail($id);
        $volunteer->update([
            'name' => $validated['nama'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'category' => $validated['kategori'] ?? null,
            'registered_at' => $validated['date'] ?? null,
            'is_verified' => $validated['isVerified'] ?? true,
        ]);

        return response()->json([
            'message' => 'Data relawan berhasil diperbarui.',
            'data' => $this->transformVolunteer($volunteer->fresh()),
        ]);
    }

    private function destroyVolunteer(int $id): JsonResponse
    {
        Volunteer::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Data relawan berhasil dihapus.',
        ]);
    }

    private function transformDonor(Donor $item): array
    {
        return [
            'id' => $item->id,
            'nama' => $item->name,
            'email' => $item->email,
            'totalDonasi' => (int) $item->total_donation,
            'lastDonasi' => $item->last_donation ? substr((string) $item->last_donation, 0, 10) : null,
        ];
    }

    private function transformBeneficiary(Beneficiary $item): array
    {
        return [
            'id' => $item->id,
            'nama' => $item->name,
            'program' => $item->program_name,
            'lokasi' => $item->location,
            'nilai' => (int) $item->assistance_value,
        ];
    }

    private function transformVolunteer(Volunteer $item): array
    {
        return [
            'id' => $item->id,
            'nama' => $item->name,
            'email' => $item->email,
            'phone' => $item->phone,
            'kategori' => $item->category,
            'date' => $item->registered_at ? substr((string) $item->registered_at, 0, 10) : null,
            'isVerified' => (bool) $item->is_verified,
        ];
    }
}
