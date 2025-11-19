<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
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
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('events', EventController::class);

        // BOOKINGS ADMIN
        Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index');
        Route::get('bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');

        // NEW LOGIC (confirm & reject)
        Route::post('bookings/{booking}/confirm', [BookingController::class, 'confirmPayment'])->name('bookings.confirm');
        Route::post('bookings/{booking}/reject', [BookingController::class, 'rejectPayment'])->name('bookings.reject');

        Route::delete('bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
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
