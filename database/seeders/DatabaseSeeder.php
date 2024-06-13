<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // UserSeeder::class,
            CustomerTitleSeeder::class,
            MaritalStatusSeeder::class,
            BloodTypeSeeder::class,
            // UserSeeder::class,
            CountrySeeder::class,
            StateSeeder::class,
            QuestionSeeder::class,
        ]);

        // User::create([
        //     'name' => 'Super Admin',
        //     'staff_no' => '000000001',
        //     'password' => bcrypt('password'),
        //     'username' => 'admin',
        // ]);
    }
}
