<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransferDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch data from Analytic in batches of 1000 rows
        $offset = 0;
        $limit = 1000;
        do {
            $customers = DB::connection('ANALYTIC-STG')
                ->table('customers')
                ->offset($offset)
                ->limit($limit)
                ->get();

            // Insert data into CRM
            foreach ($customers as $customer) {
                DB::connection('CRM-STG')->table('customers')->insert([
                    'id' => $customer->id,
                    'name' => $customer->customer_name,
                    'phone' => $customer->customer_tel,
                ]);
            }

            $offset += $limit;
        } while ($customers->count() > 0);
    }
}
