<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class UserJob implements ShouldQueue
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
        $customers = DB::connection('ANALYTIC-LIVE')
            ->table('order_incharges')
            ->where('id', '>', $lastProcessedRow)
            ->where('id', '<=', $lastProcessedRow + 100)
            ->get();

        // Insert data into CRM
        foreach ($customers as $row) {
            // Insert the customer data into CRM
            DB::connection('CRM')->table('users')->insert([
                'id' => $row->id,
                'staff_id' => $row->staff_id,
                'name' => $row->name,
                'password' => bcrypt('password'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
