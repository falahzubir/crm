<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TransferDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the last processed row from storage
        $lastProcessedRow = Storage::exists('last_processed_row.txt') ? intval(Storage::get('last_processed_row.txt')) : 0;
        $lastProcessedRow = intval($lastProcessedRow);

        // Get data from the analytic table starting from the last processed row
        $customers = DB::connection('ANALYTIC-STG')
            ->table('customers')
            ->where('id', '>', $lastProcessedRow)
            ->take(1000) // Insert 1000 rows at a time
            ->get();

        // Insert data into CRM
        foreach ($customers as $customer) {
            // Insert the customer data into CRM
            DB::connection('CRM-STG')->table('customers')->insert([
                'id' => $customer->id,
                'name' => $customer->customer_name,
                'phone' => $customer->customer_tel,
            ]);

            // Update the last processed row
            $lastProcessedRow = $customer->id;
        }

        // Store the last processed row for resuming later
        Storage::put('last_processed_row.txt', $lastProcessedRow);
    }
}
