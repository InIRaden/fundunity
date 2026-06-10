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
            $http = Http::asForm();
            
            // Hanya matikan verifikasi SSL saat di local development (untuk mengatasi error cURL 60 di Windows)
            if (app()->isLocal()) {
                $http->withoutVerifying();
            }

            $response = $http->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret'   => $secret,
                'response' => $value,
                'remoteip' => request()->ip(),
            ]);

            $data = $response->json();
            \Illuminate\Support\Facades\Log::info('reCAPTCHA verification response', ['data' => $data]);

            if (! ($data['success'] ?? false)) {
                $fail('Verifikasi reCAPTCHA gagal. Silakan coba lagi.');
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('reCAPTCHA verification error', ['error' => $e->getMessage()]);
            // Jika koneksi ke Google gagal (misalnya lokal tanpa internet), tetap lewatkan
            // saat menggunakan dummy key Google (6LeIxAcT...) yang selalu berhasil secara lokal.
            $fail('Verifikasi reCAPTCHA tidak dapat dilakukan. Coba lagi.');
        }
    }
}
