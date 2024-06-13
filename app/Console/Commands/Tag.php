<?php

namespace App\Console\Commands;

use App\Jobs\CustomerTagJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Tag extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:tag';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //get all total cust from analytics
        $getTotalCount = DB::connection('ANALYTIC-LIVE')->table('tags')->count();

        // Last table row
        $start = 0;
        $end = $getTotalCount;

        $totalDivide = ceil($end/100);

        // $totalDivide = 2;//test

        for ($x = 0; $x < $totalDivide; $x++) {

            CustomerTagJob::dispatch($x);
        }
    }
}
