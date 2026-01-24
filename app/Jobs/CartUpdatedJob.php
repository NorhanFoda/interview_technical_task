<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;

class CartUpdatedJob implements ShouldDispatchAfterCommit
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Order $order)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // TODO:: handle sending notifications to user via email or sms or app notifications
    }
}
