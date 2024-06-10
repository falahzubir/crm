<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Last table row
        $lastProcessedRow = 0;

        // Get data from the analytic table starting from the last processed row
        $staffAccessProfile = DB::connection('ED-STG')
            ->table('staff_access_profile')
            ->where('access_profile_id', '>', $lastProcessedRow)
            ->take(100) // Insert 1000 rows at a time
            ->get();

        // Insert data into CRM
        foreach ($staffAccessProfile as $row) {
            // Insert the customer data into CRM
            DB::connection('CRM-STG')->table('roles')->insert([
                'id' => $row->access_profile_id,
                'name' => $row->access_profile_name,
            ]);
        }
    }
}
