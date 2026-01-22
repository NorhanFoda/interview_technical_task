@extends('dashboard.layout.app')

@section('title', 'Edit Product')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Product: {{ $product->name }}</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('dashboard.products.update', $product) }}" method="POST">
                @csrf
                @method('PUT')
                @include('dashboard.products._partials._form', ['product' => $product])
            </form>
        </div>
    </div>
@endsection
