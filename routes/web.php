<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================
// ADMIN ROUTES
// ==========================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });


// ==========================
// CUSTOMER ROUTES
// ==========================
Route::middleware(['auth', 'role:customer'])
    ->group(function () {
        Route::get('/home', function () {
            return view('home');
        })->name('customer.home');
    });


require __DIR__ . '/auth.php';
