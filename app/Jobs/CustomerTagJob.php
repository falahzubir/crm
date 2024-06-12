<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CustomerTagJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $occurence;

    /**
     * Create a new job instance.
     */
    public function __construct($occurence)
    {
        $this->occurence = $occurence;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Last table row
        $lastProcessedRow = $this->occurence * 100;

        // Get data from the analytic table starting from the last processed row
        $tags = DB::connection('ANALYTIC-LIVE')
            ->table('customer_tags')
            ->where('id', '>', $lastProcessedRow)
            ->where('id', '<=', $lastProcessedRow + 100)
            ->get();

        // Insert data into CRM
        foreach ($tags as $tag) {
            // Insert the customer data into CRM
            DB::connection('CRM')->table('customer_tags')->insert([
                'id' => $tag->id,
                'customer_id' => $tag->customer_id,
                'tag_id' => $tag->tag_id,
                'created_at' => $tag->created_at,
                'updated_at' => $tag->updated_at,
            ]);
        }
    }
}
