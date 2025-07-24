<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ReservationController extends Controller
{
    //View to create a reservation
    function create() {

    }

    // Save the model to database
    function store(StoreReservationRequest $request) {
        
        // Create a new reservation
        $reservation = Reservation::create($request->validated());

        // Redirect or return a response
        return redirect()->route('reservation.view', ['id' => $reservation->id])
                         ->with('success', 'Reservation created successfully!');

    }

    //route to view a reservation
    function view(Reservation $id) {
        $reservation = $id;
        return view('reservation.view', [
            'reservation' => $reservation,
        ]);
    }

    function update() {
        
    }

    function delete() {

    }
}
