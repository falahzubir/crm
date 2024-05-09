<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if the customers table doesn't exist in CRM database
        if (!Schema::connection('CRM-STG')->hasTable('customers_test')) {
            // Create customers table in CRM database
            Schema::connection('CRM-STG')->create('customers_test', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('phone');
                $table->timestamps();
            });
        }

        // Fetch data from Analytic
        $customers = DB::connection('ANALYTIC-STG')->table('customers')->get();

        // Insert data into CRM
        foreach ($customers as $customer) {
            DB::connection('CRM-STG')->table('customers_test')->insert([
                'name' => $customer->customer_name,
                'phone' => $customer->customer_tel,
                // Map other columns as needed
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('crm', function (Blueprint $table) {
            //
        });
    }
};
