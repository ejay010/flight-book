<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TransactionsController;
use App\Models\Destination;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    // Fetch all destinations from the database
    $destinations = Destination::all();
    return view('welcome', compact('destinations'));
})->name('home');

Route::get('/admin', function () {
    return view('admin.home');
})->name('admin.home');

Route::get('/admin/departures-and-destinations', [DestinationController::class, 'index'])->name('admin.departures.index');

Route::get('/admin/departures-and-destinations/create', function() {
    return view('admin.departures.create');
})->name('admin.departures.create');

// Admin Login route
Route::get('/admin/login', function() {
    return view('admin.auth.login');
})->name('admin.login');

Route::post('/admin/login', function() {
    // Handle admin login logic here
    // Validate credentials
    request()->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:8',
    ]);

    // Attempt to authenticate the admin user
    if (auth()->attempt(['email' => request('email'), 'password' => request('password'), 'is_admin' => true])) {
        // Authentication passed, redirect to admin home
        return redirect()->route('admin.home');
    } else {
        // Authentication failed, redirect back with error
        return redirect()->route('admin.login')->withErrors(['email' => 'Invalid credentials or not an admin user.']);
    }
})->name('admin.login.submit');


// Admin Departures and Destinations CRUD routes
Route::post('/admin/departures-and-destinations', [DestinationController::class, 'store'])->name('admin.departures.store');
Route::get('/admin/departures-and-destinations/{id}/edit', [DestinationController::class, 'edit'])->name('admin.departures.edit');
Route::patch('/admin/departures-and-destinations/{id}', [DestinationController::class, 'update'])->name('admin.departures.update');
Route::delete('/admin/departures-and-destinations/{id}', [DestinationController::class, 'destroy'])->name('admin.departures.delete');

// Admin Reservations CRUD routes
Route::get('/admin/reservations', [AdminController::class, 'indexReservation'])->name('admin.reservations.index');
Route::get('/admin/reservations/create', [AdminController::class, 'createReservation'])->name('admin.reservations.create');
Route::post('/admin/reservations', [AdminController::class, 'storeReservation'])->name('admin.reservations.store');
Route::get('/admin/reservations/{id}', [AdminController::class, 'viewReservation'])->name('admin.reservations.view');
Route::get('/admin/reservations/{id}/edit', [AdminController::class, 'editReservation'])->name('admin.reservations.edit');
Route::patch('/admin/reservations/{id}/edit', [AdminController::class, 'updateReservation'])->name('admin.reservations.update');
Route::post('/admin/reservations/{id}/invoice/send', [AdminController::class, 'invoiceAndSendReservation'])->name('admin.reservations.confirmAndInvoice');

// Admin Transactions routes
Route::get('/admin/transactions', [TransactionsController::class, 'index'])->name('admin.transactions.index');
Route::get('/admin/transactions/{id}', [TransactionsController::class, 'view'])->name('admin.transactions.view');

// Admin User Management routes
Route::get('/admin/users/create', [App\Http\Controllers\AdminController::class, 'createAdmin'])->name('admin.users.create');
Route::post('/admin/users', [App\Http\Controllers\AdminController::class, 'storeAdmin'])->name('admin.users.store');

// Admin Settings route
Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings.index');

//Customer Facing routes
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');
Route::get('/reservation/{id}', [ReservationController::class, 'view'])->name('reservation.view');
