@extends('dashboard.layout.app')

@section('title', 'Edit User')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit User: {{ $user->name }}</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('dashboard.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                @include('dashboard.users._partials._form', ['user' => $user])
            </form>
        </div>
    </div>
@endsection
