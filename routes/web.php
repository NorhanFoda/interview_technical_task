<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ {
    UserController
};

Route::get('/', function () {
    return view('dashboard.home.index');
})->name('dashboard.home');

Route::name('dashboard.')->prefix('dashboard')->group(function () {
    Route::resource('users', UserController::class);
});
