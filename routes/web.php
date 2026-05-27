<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('guest')->group(function (): void {
	Route::get('/login', [SessionController::class, 'create'])->name('login');
	Route::post('/login', [SessionController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function (): void {
	Route::post('/people', [HomeController::class, 'store'])->name('people.store');
	Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');
});
