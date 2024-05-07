<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        State::insert([
            ['name' => 'Perlis', 'country_id' => 1, 'key' => 'PER'],
            ['name' => 'Kedah', 'country_id' => 1, 'key' => 'KDH'],
            ['name' => 'Pulau Pinang', 'country_id' => 1, 'key' => 'PNG'],
            ['name' => 'Perak', 'country_id' => 1, 'key' => 'PRK'],
            ['name' => 'Selangor', 'country_id' => 1, 'key' => 'SGR'],
            ['name' => 'Negeri Sembilan', 'country_id' => 1, 'key' => 'NSN'],
            ['name' => 'Melaka', 'country_id' => 1, 'key' => 'MLK'],
            ['name' => 'Johor', 'country_id' => 1, 'key' => 'JHR'],
            ['name' => 'Pahang', 'country_id' => 1, 'key' => 'PHG'],
            ['name' => 'Terengganu', 'country_id' => 1, 'key' => 'TRG'],
            ['name' => 'Kelantan', 'country_id' => 1, 'key' => 'KTN'],
            ['name' => 'Sabah', 'country_id' => 1, 'key' => 'SBH'],
            ['name' => 'Sarawak', 'country_id' => 1, 'key' => 'SWK'],
            ['name' => 'Wilayah Persekutuan Kuala Lumpur', 'country_id' => 1, 'key' => 'KUL'],
            ['name' => 'Wilayah Persekutuan Labuan', 'country_id' => 1, 'key' => 'LBN'],
            ['name' => 'Wilayah Persekutuan Putrajaya', 'country_id' => 1, 'key' => 'PJY']
        ]);
    }
}
