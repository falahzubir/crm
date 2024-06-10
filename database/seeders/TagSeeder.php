<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Last table row
        $lastProcessedRow = 10;

        // Get data from the analytic table starting from the last processed row
        $tags = DB::connection('ANALYTIC-STG')
            ->table('tags')
            ->where('id', '>', $lastProcessedRow)
            ->take(1000)
            ->get();

        // Insert data into CRM
        foreach ($tags as $tag) {
            // Insert the customer data into CRM
            DB::connection('CRM-STG')->table('tags')->insert([
                'id' => $tag->id,
                'name' => $tag->name,
            ]);
        }
    }
}
