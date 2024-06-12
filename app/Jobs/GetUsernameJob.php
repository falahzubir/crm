<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class GetUsernameJob implements ShouldQueue
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

        // Get data from CRM
        $crmUsers = DB::connection('CRM')
            ->table('users')
            ->where('id', '>', $lastProcessedRow)
            ->where('id', '<=', $lastProcessedRow + 100)
            ->get();

        foreach ($crmUsers as $crmUser) {
            // Fetch username from EH database
            $usernameEH = DB::connection('EH')
                ->table('staff_main')
                ->where('staff_id', $crmUser->staff_id)
                ->value('username');

            // Fetch username from ED database
            $usernameED = DB::connection('ED')
                ->table('staff_main')
                ->where('staff_id', $crmUser->staff_id)
                ->value('username');

            // Fetch username from EI database
            $usernameEI = DB::connection('EI')
                ->table('staff_main')
                ->where('staff_id', $crmUser->staff_id)
                ->value('username');

            // Determine the latest username
            $latestUsername = $usernameEI ?? $usernameED ?? $usernameEH;

            // Update the CRM-STG users table if a username was found
            if ($latestUsername) {
                DB::connection('CRM')->table('users')->where('staff_id', $crmUser->staff_id)->update([
                    'username' => $latestUsername,
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
