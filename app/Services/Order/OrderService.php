<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Enums\OrderType;
use App\Enums\OrderStatus;
use App\Events\OrderPaidEvent;
use App\Events\OrderCreatedEvent;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\OrderContract;

class OrderService
{
    public function __construct(public OrderContract $orderContract) {}
    public function purchase(int $orderId): string
    {
        return DB::transaction(function () use ($orderId) {
            $order = $this->orderContract->findAndLock($orderId, ['items.product']);
            if (!$order) {
                throw new \Exception('Order not found');
            }
            $order->update(['type' => OrderType::ORDER->value, 'status' => OrderStatus::PROCESSING->value]);
            $order = $this->createPaymentDetails($order);
            event(new OrderCreatedEvent($order));
            $url = $this->preparePaymentUrl($order);
            return $url;
        });
    }

    public function createPaymentDetails(Order $order): Order
    {
        if (!$order->paymentDetails) {
            $order->paymentDetails()->create([
                /** payment details */
            ]);
        }
        return $order;
    }

    public function preparePaymentUrl(Order $order): string
    {
        $order->load('paymentDetails');
        // TODO:: create transaction log
        // TODO:: prepare payment url
        $url = 'https://example.com/payment/' . $order->id;
        return $url;
    }

    public function confirmPayment(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            $order = $this->orderContract->findAndLock($data['order_id']);
            if (!$order) {
                throw new \Exception('Order not found');
            }

            if ($order->status === OrderStatus::COMPLETED->value) {
                return $order;
            }
            $order->update(['status' => OrderStatus::COMPLETED->value]); // status depends on the payment status from the payment gateway
            // TODO:: update payment details
            // TODO:: update transaction log
            event(new OrderPaidEvent($order));
            $this->reduceStock($order);
            return $order->refresh();
        });
    }

    public function reduceStock(Order $order): void
    {
        // TODO:: reduce stock for the order
        
    }
}
