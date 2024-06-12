<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class RoleJob implements ShouldQueue
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
        $staffAccessProfile = DB::connection('EH')
            ->table('staff_access_profile')
            ->where('access_profile_id', '>', $lastProcessedRow)
            ->where('access_profile_id', '<=', $lastProcessedRow + 100)
            ->get();

        // Insert data into CRM
        foreach ($staffAccessProfile as $row) {
            // Insert the customer data into CRM
            DB::connection('CRM')->table('roles')->insert([
                'id' => $row->access_profile_id,
                'name' => $row->access_profile_name,
            ]);
        }
    }
}
