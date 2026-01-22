@extends('dashboard.layout.app')

@section('title', 'Edit Role')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Role: {{ $role->name }}</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('dashboard.roles.update', $role) }}" method="POST">
                @csrf
                @method('PUT')
                @include('dashboard.roles._partials._form', ['role' => $role])
            </form>
        </div>
    </div>
@endsection
