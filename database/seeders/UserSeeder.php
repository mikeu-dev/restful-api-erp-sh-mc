<?php

namespace Database\Seeders;

use App\Modules\User\Model\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Mikeu Dev',
                'email' => 'mikeu@test.com',
                'username' => 'mikeudev',
                'password' => env('DEF_SUPERADMIN'),
                'role' => 'Super Admin',
                'email_verified_at' => now()
            ],
            [
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'username' => 'admin',
                'password' => env('DEF_ADMIN'),
                'role' => 'Administrator',
                'email_verified_at' => now()
            ],
            [
                'name' => 'Developer',
                'email' => 'developer@example.com',
                'username' => 'developer',
                'password' => env('DEF_DEV'),
                'role' => 'Developer',
                'email_verified_at' => now()
            ],
            [
                'name' => 'Finance',
                'email' => 'finance@example.com',
                'username' => 'finance',
                'password' => env('DEF_FINANCE'),
                'role' => 'Finance',
                'email_verified_at' => now()
            ],
            [
                'name' => 'Internship',
                'email' => 'intern@example.com',
                'username' => 'intern',
                'password' => env('DEF_INTERN'),
                'role' => 'Internship',
                'email_verified_at' => now()
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                [
                    'email' => $userData['email'],
                    'username' => $userData['username'],
                ],
                [
                    'name' => $userData['name'],
                    'email_verified_at' => $userData['email_verified_at'],
                    'password' => Hash::make($userData['password']),
                ]
            );

            // Assign role menggunakan Spatie Permission
            $user->assignRole($userData['role']);
        }
    }
}
