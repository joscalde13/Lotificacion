<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Seed users for asesor and oficina roles.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Usuario Asesor',
                'email' => 'asesor@nuevjerusalem.com',
                'password' => 'Asesor12345',
                'role' => 'asesor',
            ],
            [
                'name' => 'Usuario Oficina',
                'email' => 'oficina@nuevjerusalem.com',
                'password' => 'Oficina12345',
                'role' => 'oficina',
            ],
        ];

        foreach ($users as $payload) {
            User::updateOrCreate(
                ['email' => $payload['email']],
                [
                    'name' => $payload['name'],
                    'password' => $payload['password'],
                    'role' => $payload['role'],
                    'email_verified_at' => now(),
                ],
            );
        }
    }
}
