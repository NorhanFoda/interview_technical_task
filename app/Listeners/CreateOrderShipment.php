<?php

namespace App\Listeners;

use App\Events\OrderPaidEvent;
use App\Jobs\CreateShipmentJob;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;

class CreateOrderShipment implements ShouldDispatchAfterCommit
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
        dispatch(new CreateShipmentJob($event->order));
    }
}
