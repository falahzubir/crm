<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CustomerPICSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Last table row
        $lastProcessedRow = 893;

        // Get data from the analytic table starting from the last processed row
        $orders = DB::connection('ANALYTIC-LIVE')
            ->table('orders')
            ->where('id', '>', $lastProcessedRow)
            ->take(1000) // Insert 1000 rows at a time
            ->get();

        // Insert data into CRM
        foreach ($orders as $row) {
            // Check if the customer_id exists in the customers table
            $customerExists = DB::connection('CRM-STG')
                ->table('customers')
                ->where('id', $row->customer_id)
                ->exists();

            if ($customerExists) {
                // Insert the customer data into CRM if the customer_id exists
                DB::connection('CRM-STG')->table('customer_p_i_c_s')->insert([
                    'customer_id' => $row->customer_id,
                    'user_id' => $row->order_incharge_id,
                ]);
            }
        }
    }
}
