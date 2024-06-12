<?php

namespace App\Console\Commands;

use App\Jobs\UserJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class User extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Take order incharges and put it on users table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //get all total cust from analytics
        $getTotalCount = DB::connection('ANALYTIC-LIVE')->table('order_incharges')->count();

        // Last table row
        $start = 0;
        $end = $getTotalCount;

        $totalDivide = ceil($end/100);

        // $totalDivide = 2;//test

        for ($x = 0; $x < $totalDivide; $x++) {

            UserJob::dispatch($x);
        }
    }
}
