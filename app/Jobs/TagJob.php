<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TagJob implements ShouldQueue
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
            ->table('tags')
            ->where('id', '>', $lastProcessedRow)
            ->where('id', '<=', $lastProcessedRow + 100)
            ->get();

        // Insert data into CRM
        foreach ($tags as $tag) {
            // Insert the customer data into CRM
            DB::connection('CRM')->table('tags')->insert([
                'id' => $tag->id,
                'name' => $tag->name,
            ]);
        }
    }
}
