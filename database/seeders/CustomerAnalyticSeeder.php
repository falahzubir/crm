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

        // Get data from the analytic customers and customer addresses tables with join
        $combinedData = DB::connection('ANALYTIC-STG')
            ->table('customers')
            ->join('customer_addresses', 'customers.id', '=', 'customer_addresses.customer_id')
            ->select('customers.id', 'customers.customer_name as name', 'customers.customer_tel as phone', 'customer_addresses.street as address', 'customer_addresses.city', 'customer_addresses.postal_code', 'customer_addresses.state_id')
            ->where('customers.id', '>', $lastProcessedRow)
            ->take(100)
            ->get();

        // Insert combined data into CRM
        foreach ($combinedData as $data) {
            // Insert the customer data into CRM
            DB::connection('CRM-STG')->table('customers')->insert([
                'id' => $data->id,
                'name' => $data->name,
                'phone' => $data->phone,
                'address' => $data->address,
                'city' => $data->city,
                'postcode' => $data->postal_code,
                'state_id' => $data->state_id,
            ]);
        }
    }
}
