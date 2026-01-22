<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\OrderContract;

class OrderController extends Controller
{
    protected string $indexView = 'dashboard.orders.index';
    protected string $showView = 'dashboard.orders.show';
    protected array $filters = [];

    public function __construct(protected OrderContract $contract)
    {
        $this->middleware('permission:orders.view')->only(['index', 'show']);
        $this->filters = request()->all();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = $this->contract->search($this->filters, ['user']);
        return view($this->indexView, compact('models'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view($this->showView, compact('order'));
    }
}
