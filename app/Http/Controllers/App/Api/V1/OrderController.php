<?php

namespace App\Http\Controllers\App\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Order\OrderService;
use App\Http\Requests\App\Api\PurchaseOrderRequest;

class OrderController extends Controller
{

    public function __construct(public OrderService $orderService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //TODO:: Show orders list with status
    }

    /**
     * Store a newly created resource in storage.
     */
    public function purchase(PurchaseOrderRequest $request)
    {
        try {
            $url = $this->orderService->purchase(orderId: $request->validated()['order_id']);
            return response()->json(['message' => 'Your order is processed for payment', 'data' => ['url' => $url]]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function confirmPayment(Request $request)
    {
        // TODO:: handle payment callback
        try {
            $this->orderService->confirmPayment($request->all());
            return response()->json(['message' => 'Payment confirmed successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //TODO:: Show order details
    }

}
