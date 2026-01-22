@extends('dashboard.layout.app')

@section('title', 'Create Role')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Role</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('dashboard.roles.store') }}" method="POST">
                @csrf
                @include('dashboard.roles._partials._form')
            </form>
        </div>
    </div>
@endsection
