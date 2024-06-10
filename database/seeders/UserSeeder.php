<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::create([
        //     'name' => 'Super Admin',
        //     'staff_no' => '000000001',
        //     'password' => bcrypt('password'),
        // ]);

        // Last table row
        $lastProcessedRow = 2000;
        
        // Get data from the analytic table starting from the last processed row
        $order_incharges = DB::connection('ANALYTIC-LIVE')
            ->table('order_incharges')
            ->where('id', '>', $lastProcessedRow)
            ->take(1000) // Insert 1000 rows at a time
            ->get();

        // Insert data into CRM
        foreach ($order_incharges as $row) {
            DB::connection('CRM-STG')->table('users')->insert([
                'id' => $row->id,
                'staff_id' => $row->staff_id,
                'name' => $row->name,
                'password' => bcrypt('password'),
            ]);
        }
    }
}
