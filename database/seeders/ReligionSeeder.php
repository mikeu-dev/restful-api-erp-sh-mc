<?php

namespace Database\Seeders;

use App\Modules\Religion\Model\Religion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Islam',
            'Kristen',
            'Katolik',
            'Hindu',
            'Budha',
            'Konnghucu'
        ];

        foreach ($data as $d)
        {
            Religion::create([
                'name' => $d
            ]);
        }
    }
}
