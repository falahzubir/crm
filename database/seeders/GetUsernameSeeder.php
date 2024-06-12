<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class GetUsernameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get data from CRM-STG
        $crmUsers = DB::connection('CRM-STG')->table('users')->get();

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
                DB::connection('CRM-STG')->table('users')->where('staff_id', $crmUser->staff_id)->update([
                    'username' => $latestUsername,
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
