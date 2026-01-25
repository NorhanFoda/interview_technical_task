<?php

namespace App\Listeners;

use App\Events\OrderCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyOrderStatus
{
    public function handle(OrderCreatedEvent $event): void
    {
        $order = $event->order;
        // TODO:: Notify user via email or sms or app notifications with $order->status
    }
}
