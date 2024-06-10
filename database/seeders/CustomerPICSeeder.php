<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CustomerAnalyticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Last table row
        $lastProcessedRow = 0;

        // Get data from the analytic table starting from the last processed row
        $customers = DB::connection('ANALYTIC-STG')
            ->table('orders')
            ->where('id', '>', $lastProcessedRow)
            ->take(100) // Insert 1000 rows at a time
            ->get();

        // Insert data into CRM
        foreach ($customers as $customer) {
            // Insert the customer data into CRM
            DB::connection('CRM-STG')->table('customers')->insert([
                'id' => $customer->id,
                'name' => $customer->customer_name,
                'phone' => $customer->customer_tel,
            ]);
        }
    }
}
