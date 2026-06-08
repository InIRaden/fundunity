<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements ValidationRule
{
    /**
     * Validasi token reCAPTCHA v2 dari Google.
     * Tidak memerlukan package tambahan - menggunakan HTTP client bawaan Laravel.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (empty($value)) {
            $fail('Tolong verifikasi bahwa Anda bukan robot.');
            return;
        }

        $secret = env('NOCAPTCHA_SECRET');

        try {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret'   => $secret,
                'response' => $value,
                'remoteip' => request()->ip(),
            ]);

            $data = $response->json();

            if (! ($data['success'] ?? false)) {
                $fail('Verifikasi reCAPTCHA gagal. Silakan coba lagi.');
            }
        } catch (\Exception $e) {
            // Jika koneksi ke Google gagal (misalnya lokal tanpa internet), tetap lewatkan
            // saat menggunakan dummy key Google (6LeIxAcT...) yang selalu berhasil secara lokal.
            $fail('Verifikasi reCAPTCHA tidak dapat dilakukan. Coba lagi.');
        }
    }
}
