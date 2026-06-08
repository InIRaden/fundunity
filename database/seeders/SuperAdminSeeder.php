<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Membuat akun Super Admin dari variabel .env / Railway Variables.
     * Aman dijalankan berulang kali (firstOrCreate).
     */
    public function run(): void
    {
        $email = env('SUPER_ADMIN_EMAIL', 'super@fundunity.id');
        $password = env('SUPER_ADMIN_PASSWORD', 'fundunity@super123');
        $name = env('SUPER_ADMIN_NAME', 'Super Admin FundUnity');

        User::firstOrCreate(
            ['email' => $email],
            [
                'name'                 => $name,
                'password'             => Hash::make($password),
                'role'                 => 'super_admin',
                'must_change_password' => false,
                'email_verified_at'    => now(),
            ]
        );

        $this->command->info("Super Admin siap: {$email}");
    }
}
