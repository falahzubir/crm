<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::insert([
            ['name' => 'Malaysia', 'flag' => '🇲🇾', 'key' => 'MY'],
            ['name' => 'Singapore', 'flag' => '🇸🇬', 'key' => 'SG'],
            ['name' => 'Indonesia', 'flag' => '🇮🇩', 'key' => 'ID'],
            ['name' => 'Thailand', 'flag' => '🇹🇭', 'key' => 'TH'],
            ['name' => 'Vietnam', 'flag' => '🇻🇳', 'key' => 'VN'],
            ['name' => 'Philippines', 'flag' => '🇵🇭', 'key' => 'PH'],
            ['name' => 'Myanmar', 'flag' => '🇲🇲', 'key' => 'MM'],
            ['name' => 'Cambodia', 'flag' => '🇰🇭', 'key' => 'KH'],
            ['name' => 'Laos', 'flag' => '🇱🇦', 'key' => 'LA'],
            ['name' => 'Brunei', 'flag' => '🇧🇳', 'key' => 'BN'],
            ['name' => 'Timor-Leste', 'flag' => '🇹🇱', 'key' => 'TL'],
            ['name' => 'China', 'flag' => '🇨🇳', 'key' => 'CN'],
            ['name' => 'Hong Kong', 'flag' => '🇭🇰', 'key' => 'HK'],
            ['name' => 'Taiwan', 'flag' => '🇹🇼', 'key' => 'TW'],
            ['name' => 'Japan', 'flag' => '🇯🇵', 'key' => 'JP'],
            ['name' => 'South Korea', 'flag' => '🇰🇷', 'key' => 'KR'],
            ['name' => 'North Korea', 'flag' => '🇰🇵', 'key' => 'KP'],
            ['name' => 'Mongolia', 'flag' => '🇲🇳', 'key' => 'MN'],
            ['name' => 'Russia', 'flag' => '🇷🇺', 'key' => 'RU']
        ]); 
    }
}
