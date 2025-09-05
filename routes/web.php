<?php

use App\Http\Controllers\DestinationController;
use App\Http\Controllers\ReservationController;
use App\Models\Destination;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Fetch all destinations from the database
    $destinations = Destination::all();
    return view('welcome', compact('destinations'));
});

Route::get('/admin', function () {
    return view('admin.home');
})->name('admin.home');

Route::get('/admin/departures-and-destinations', [DestinationController::class, 'index'])->name('admin.departures.index');

Route::get('/admin/departures-and-destinations/create', function() {
    return view('admin.departures.create');
})->name('admin.departures.create');

// Admin Departures and Destinations CRUD routes
Route::post('/admin/departures-and-destinations', [DestinationController::class, 'store'])->name('admin.departures.store');
Route::get('/admin/departures-and-destinations/{id}/edit', [DestinationController::class, 'edit'])->name('admin.departures.edit');
Route::patch('/admin/departures-and-destinations/{id}', [DestinationController::class, 'update'])->name('admin.departures.update');
Route::delete('/admin/departures-and-destinations/{id}', [DestinationController::class, 'destroy'])->name('admin.departures.delete');

// Admin Reservations CRUD routes
Route::get('/admin/reservations', [ReservationController::class, 'index'])->name('admin.reservations.index');
Route::get('/admin/reservations/create', [ReservationController::class, 'create'])->name('admin.reservations.create');
Route::post('/admin/reservations', [ReservationController::class, 'store'])->name('admin.reservations.store');
Route::get('/admin/reservations/{id}', [ReservationController::class, 'view'])->name('admin.reservations.view');
Route::get('/admin/reservations/{id}/edit', [ReservationController::class, 'edit'])->name('admin.reservations.edit');

// Admin User Management routes
Route::get('/admin/users/create', [App\Http\Controllers\AdminController::class, 'createAdmin'])->name('admin.users.create');
Route::post('/admin/users', [App\Http\Controllers\AdminController::class, 'storeAdmin'])->name('admin.users.store');

//Customer Facing routes
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');
Route::get('/reservation/{id}', [ReservationController::class, 'view'])->name('reservation.view');
