<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $username = strtolower(trim((string) env('ADMIN_USERNAME')));
        $email = trim((string) env('ADMIN_EMAIL'));
        $password = (string) env('ADMIN_PASSWORD');

        if ($username === '' || ! filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 12) {
            throw new RuntimeException('Set ADMIN_USERNAME, a valid ADMIN_EMAIL, and an ADMIN_PASSWORD of at least 12 characters before seeding the administrator.');
        }

        User::firstOrCreate(
            ['username' => $username],
            [
                'name' => 'System Administrator',
                'email' => $email,
                'role' => 'System Administrator',
                'password' => Hash::make($password),
            ],
        );
    }
}
