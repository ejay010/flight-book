<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Controller methods for the admin panel can be added here

    //create an Administrator
    public function createAdmin() {
        // Show the form to create an admin
        return view('admin.settings.users.create');
    }

    // Store the new administrator
    public function storeAdmin(Request $request) {
        // Validate and store the new admin user
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_admin' => true,
        ]);

        return redirect()->route('admin.home')->with('success', 'Admin user created successfully!');

    }

    // Admin settings page
    public function settings() {
        return view('admin.settings.index');
    }

    // Rervation controlls

    public function indexReservation () {
        $reservations = Reservation::all();
        return view('admin.reservations.index', compact('reservations'));
    }

    //route to view a reservation
    function viewReservation(Reservation $id) {
        $reservation = $id;
        return view('admin.reservations.view', [
            'reservation' => $reservation,
        ]);
    }

        function editReservation(Reservation $id) {
        $reservation = $id;
        $destinations = \App\Models\Destination::all();
        return view('admin.reservations.edit', compact('reservation', 'destinations'));
    }

    function updateReservation(Reservation $id, Request $request) {
        $reservation = $id;
        $reservation->update($request->all());
        return redirect()->route('admin.reservations.view', ['id' => $reservation->id])
                         ->with('success', 'Reservation updated successfully!');

    }

    function deleteReservation(Reservation $id) {
        $reservation = $id;
        $reservation->delete();
        return redirect()->route('admin.reservations.index')
                         ->with('success', 'Reservation deleted successfully!');

    }

    // Show the view to add passenger information
    function addPassenger(Reservation $id) {
        $reservation = $id;
        return view('admin.reservations.passenger.create', compact(['reservation']));
    }

    function invoiceAndSendReservation(Reservation $id) {
        //get the reservation
        $reservation = $id;
        //update status to confirmed
        $reservation->update(['confirmation' => 'confirmed']);
        //TODO: Add to calendar
        //send customer notice of confirmation
        $primaryContact = $reservation->primary_contact;
        //create invoice
        //send customer invoice with payment link
        //notify admin that invoice was sent
    }

    function savePassenger(Reservation $id, Request $request) {
        //validate request
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'birthday' => 'required',
            'is_child' => 'required'
        ]);

        // retrieve reservation
        $reservation = $id;

        // update passenger list
        $newManifest = $reservation->passengers->push($validated);
        $reservation->update(['passengers' => $newManifest]);

        // redirect to reservation
        return redirect()->to(route('admin.reservations.edit', $reservation->id));
    }
}
