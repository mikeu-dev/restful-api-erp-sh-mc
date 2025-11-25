<?php

namespace Database\Seeders;

use App\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Company 1
        $company1 = Company::create([
            'name'      => 'PT Maju Bersama',
            'email'     => 'info@maju.com',
            'code'      => 'PTMB001',
            'tagline'   => 'Bersama Maju!',
            'director'  => 'Budi Santoso',
            'phone'     => '081234567890',
            'logo'      => 'logo_ptmb.png',
            'address'   => 'Jl. Merdeka No.1, Jakarta',
            'bank'      => 123456789,
            'number'    => 1,
        ]);

        $company1->setSetting('feature_flags', ['invoice' => true, 'reporting' => true, 'analytics' => false]);
        $company1->setSetting('theme', ['primary_color' => '#0d6efd', 'secondary_color' => '#6c757d']);

        // Company 2
        $company2 = Company::create([
            'name'      => 'CV Sukses Abadi',
            'email'     => 'contact@sukses.com',
            'code'      => 'CVSA002',
            'tagline'   => 'Sukses Tanpa Batas',
            'director'  => 'Siti Rahma',
            'phone'     => '081298765432',
            'logo'      => 'logo_cvsa.png',
            'address'   => 'Jl. Pahlawan No.5, Bandung',
            'bank'      => 987654321,
            'number'    => 2,
        ]);

        $company2->setSetting('feature_flags', ['invoice' => true, 'reporting' => false, 'analytics' => true]);
        $company2->setSetting('theme', ['primary_color' => '#198754', 'secondary_color' => '#ffc107']);
    }
}
