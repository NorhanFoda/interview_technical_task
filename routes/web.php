<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ {
    UserController,
    RoleController
};

use App\Http\Controllers\Auth\AuthController;

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('dashboard.home.index');
    })->name('dashboard.home');

    Route::name('dashboard.')->prefix('dashboard')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
    });
});
