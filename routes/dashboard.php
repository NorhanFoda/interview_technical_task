<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ {
    UserController,
    RoleController,
    ProductController,
    OrderController
};

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('dashboard.home.index');
    })->name('dashboard.home');

    Route::name('dashboard.')->prefix('dashboard')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('products', ProductController::class);
        Route::resource('orders', OrderController::class)->only(['index', 'show']);
    });
});
