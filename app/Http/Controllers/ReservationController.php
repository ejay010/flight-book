<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ReservationController extends Controller
{
    //View to create a reservation
    function create() {

    }

    // Save the model to database
    function store(Request $request) {
        // Validate the request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'birthday' => 'required|date',
            'phone_number' => 'required|string|max:20',
            'trip_type' => 'required|string|in:one-way,round-trip',
            'departure' => 'required|string|max:255',
            'departure_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:departure_date',
            'destination' => 'required|string|max:255',
            'bag_count' => 'required|integer|min:0|max:10',
        ]);

        // Create a new reservation
        $reservation = Reservation::create($validatedData);

        // Redirect or return a response
        return redirect()->route('reservation.view', ['id' => $reservation->id])
                         ->with('success', 'Reservation created successfully!');

    }

    //route to view a reservation
    function view(Reservation $id) {
        dd($id);
    }

    function update() {
        
    }

    function delete() {

    }
}
