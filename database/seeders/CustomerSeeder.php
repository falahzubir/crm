<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'name' => 'John Doe',
            'nickname' => 'JD',
            'title_id' => null,
            'gender' => 'Male',
            'age' => null,
            'blood_type_id' => null,
            'photo' => 'path/to/photo.jpg',
            'marital_status_id' => null,
            'phone' => '1234567890',
            'birth_order' => null,
            'birth_place' => 'City',
            'weight' => null,
            'height' => null,
            'address' => '123 Main St',
            'postcode' => '12345',
            'city' => 'City',
            'state_id' => null,
            'occupation' => 'Engineer',
            'sector' => 'Private',
            'identification_number' => 'ID123456',
            'Identification_number_police' => 'IDP123456',
            'salary_range_id' => null,
            'tier_id' => null,
            'working_hour' => 'Full-time',
            'additional_tags' => 'Tag1, Tag2',
            'updated_by' => null,
        ]);
    }
}
