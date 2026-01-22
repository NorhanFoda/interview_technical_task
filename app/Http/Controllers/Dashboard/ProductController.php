<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ProductContract;
use App\Http\Requests\Dashboard\ProductRequest;

class ProductController extends Controller
{
    protected string $indexView = 'dashboard.products.index';
    protected string $createView = 'dashboard.products.create';
    protected string $editView = 'dashboard.products.edit';
    protected string $showView = 'dashboard.products.show';
    protected string $formView = 'dashboard.products._partials._form';
    protected string $tableView = 'dashboard.products._partials._table';
    protected array $filters = [];

    public function __construct(protected ProductContract $contract)
    {
        $this->middleware('permission:products.view')->only(['index', 'show']);
        $this->middleware('permission:products.create')->only(['create', 'store']);
        $this->middleware('permission:products.update')->only(['edit', 'update']);
        $this->middleware('permission:products.delete')->only(['destroy']);
        $this->filters = request()->all();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = $this->contract->search($this->filters);
        return view($this->indexView, compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->createView);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $this->contract->create($request->all());
        return redirect()->route('dashboard.products.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view($this->showView, compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view($this->editView, compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $this->contract->update($product, $request->all());
        return redirect()->route('dashboard.products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->contract->remove($product);
        return redirect()->route('dashboard.products.index')->with('success', 'Product deleted successfully');
    }
}
