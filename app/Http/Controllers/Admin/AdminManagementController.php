<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminManagementController extends Controller
{
    /**
     * Tampilkan halaman manajemen admin.
     */
    public function index(): View
    {
        $admins = User::where('role', 'admin')
            ->orderByDesc('created_at')
            ->get();

        $pageMeta = [
            'title'    => 'Manajemen Admin',
            'subtitle' => 'Kelola akun administrator sistem FundUnity',
        ];

        return view('admin.management', compact('admins', 'pageMeta'));
    }

    /**
     * Buat admin baru dengan password acak.
     * Hanya bisa diakses Super Admin.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
        ], [
            'email.unique' => 'Email ini sudah terdaftar di sistem.',
        ]);

        // Generate password acak yang kuat
        $plainPassword = $this->generatePassword();

        $admin = User::create([
            'name'                 => $validated['name'],
            'email'                => $validated['email'],
            'password'             => Hash::make($plainPassword),
            'role'                 => 'admin',
            'must_change_password' => true,
            'email_verified_at'    => now(),
        ]);

        return response()->json([
            'message'  => 'Akun admin berhasil dibuat.',
            'admin'    => [
                'id'    => $admin->id,
                'name'  => $admin->name,
                'email' => $admin->email,
            ],
            'password' => $plainPassword, // Ditampilkan SEKALI ke Super Admin via pop-up
        ]);
    }

    /**
     * Reset sandi admin SEMENTARA.
     * Hanya bisa jika admin masih belum ganti sandi (must_change_password = true).
     */
    public function resetPassword(Request $request, User $admin): JsonResponse
    {
        // Keamanan: hanya bisa reset jika admin belum pernah login & ganti sandi
        if (! $admin->must_change_password) {
            return response()->json([
                'message' => 'Tidak diizinkan. Admin ini sudah mengatur kata sandinya sendiri.',
            ], 403);
        }

        // Pastikan target adalah admin biasa (bukan super admin lain)
        if ($admin->role !== 'admin') {
            return response()->json(['message' => 'Aksi tidak valid.'], 403);
        }

        $plainPassword = $this->generatePassword();

        $admin->update([
            'password'             => Hash::make($plainPassword),
            'must_change_password' => true,
        ]);

        return response()->json([
            'message'  => 'Sandi sementara berhasil direset.',
            'admin'    => [
                'id'    => $admin->id,
                'name'  => $admin->name,
                'email' => $admin->email,
            ],
            'password' => $plainPassword,
        ]);
    }

    /**
     * Hapus akun admin.
     */
    public function destroy(User $admin): JsonResponse
    {
        if ($admin->role === 'super_admin') {
            return response()->json(['message' => 'Super Admin tidak bisa dihapus.'], 403);
        }

        $admin->delete();

        return response()->json(['message' => 'Akun admin berhasil dihapus.']);
    }

    /**
     * Generate password acak yang aman (10 karakter, mix huruf & angka).
     */
    private function generatePassword(): string
    {
        $chars   = 'abcdefghjkmnpqrstuvwxyz'; // tanpa i, l, o untuk menghindari kebingungan
        $numbers = '23456789';
        $upper   = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        $symbols = '@#$!';

        $password  = $upper[random_int(0, strlen($upper) - 1)];
        $password .= $numbers[random_int(0, strlen($numbers) - 1)];
        $password .= $symbols[random_int(0, strlen($symbols) - 1)];

        for ($i = 0; $i < 7; $i++) {
            $all      = $chars . $numbers . $upper;
            $password .= $all[random_int(0, strlen($all) - 1)];
        }

        // Acak urutan karakter
        return str_shuffle($password);
    }
}
