<?php

namespace Database\Seeders;

use App\Models\SalaryRange;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalaryRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SalaryRange::insert([
            ['name' => 'Less than RM1,500', 'min_salary' => '0.00', 'max_salary' => '1500.00'],
            ['name' => 'RM1,501 - RM3,000', 'min_salary' => '1501.00', 'max_salary' => '3000.00'],
            ['name' => 'RM3,001 - RM5,000', 'min_salary' => '3001.00', 'max_salary' => '5000.00'],
            ['name' => 'RM5,001 - RM7,000', 'min_salary' => '5001.00', 'max_salary' => '7000.00'],
            ['name' => 'More than RM7,000', 'min_salary' => '7001.00', 'max_salary' => '999999.99']
        ]);
    }
}
