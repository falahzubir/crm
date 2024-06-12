<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CustomerPICJob implements ShouldQueue
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
        $orders = DB::connection('ANALYTIC-LIVE')
            ->table('orders')
            ->where('id', '>', $lastProcessedRow)
            ->where('id', '<=', $lastProcessedRow + 100)
            ->get();

        // Insert data into CRM
        foreach ($orders as $row) {
            // Check if the customer_id exists in the customers table
            $customerExists = DB::connection('CRM')
                ->table('customers')
                ->where('id', $row->customer_id)
                ->exists();

            if ($customerExists) {
                // Insert the customer data into CRM if the customer_id exists
                DB::connection('CRM')->table('customer_p_i_c_s')->insert([
                    'customer_id' => $row->customer_id,
                    'user_id' => $row->order_incharge_id,
                ]);
            }
        }
    }
}
