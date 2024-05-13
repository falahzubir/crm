<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TagIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Last table row
        $lastProcessedRow = 11;

        // Get data from the analytic table starting from the last processed row
        $tags = DB::connection('ANALYTIC-STG')
            ->table('customer_tags')
            ->where('id', '>', $lastProcessedRow)
            ->take(1000)
            ->get();

        // Insert data into CRM
        foreach ($tags as $tag) {
            // Get the existing additional tags for the customer, if any
            $existingTags = DB::connection('CRM-STG')
                ->table('customers')
                ->where('id', '=', $tag->customer_id)
                ->value('additional_tags');

            // Concatenate the new tag ID with existing tags (if any)
            $additionalTags = $existingTags ? $existingTags . ',' . $tag->tag_id : $tag->tag_id;

            // Update the customer record with the concatenated additional tags
            DB::connection('CRM-STG')
                ->table('customers')
                ->where('id', '=', $tag->customer_id)
                ->update([
                    'additional_tags' => $additionalTags,
                ]);
        }
    }
}
