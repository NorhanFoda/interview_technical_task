<?php

namespace App\Listeners;

use App\Events\OrderPaidEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;

class NotifyOrderPaid implements ShouldDispatchAfterCommit
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderPaidEvent $event): void
    {
        //TODO:: notify user via email or sms or app notifications
    }
}
