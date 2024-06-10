<?php

namespace Database\Seeders;

use App\Models\CustomerTitle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustomerTitle::insert([
            ['name' => 'Mr'],
            ['name' => 'Mrs'],
            ['name' => 'Miss'],
            ['name' => 'Ms'],
            ['name' => 'Dr'],
            ['name' => 'Prof'],
            ['name' => 'Madam'],
            ['name' => 'Sir']
        ]);

    }
}
