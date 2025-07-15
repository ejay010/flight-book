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

Route::post('/admin/departures-and-destinations', [DestinationController::class, 'store'])->name('admin.departures.store');
Route::get('/admin/departures-and-destinations/{id}/edit', [DestinationController::class, 'edit'])->name('admin.departures.edit');
Route::patch('/admin/departures-and-destinations/{id}', [DestinationController::class, 'update'])->name('admin.departures.update');
Route::delete('/admin/departures-and-destinations/{id}', [DestinationController::class, 'destroy'])->name('admin.departures.delete');

Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');
Route::get('/reservation/{id}', [ReservationController::class, 'view'])->name('reservation.view');