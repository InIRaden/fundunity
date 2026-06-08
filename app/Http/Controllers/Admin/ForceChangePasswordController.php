<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ForceChangePasswordController extends Controller
{
    /**
     * Tampilkan halaman wajib ganti sandi.
     */
    public function show(): View
    {
        return view('admin.force-change-password');
    }

    /**
     * Proses perubahan sandi pertama kali.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
        ], [
            'password.min'       => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $user = Auth::user();
        $user->update([
            'password'             => Hash::make($request->password),
            'must_change_password' => false,
        ]);

        return redirect()->route('admin.dashboard')->with('status', 'Kata sandi berhasil diubah. Selamat datang!');
    }
}
