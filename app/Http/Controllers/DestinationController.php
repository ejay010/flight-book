<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DestinationController extends Controller
{
    //
    public function index() {
        // Fetch all destinations from the database
        $destinations = \App\Models\Destination::all();
        // Return the view with the destinations data
        return view('admin.departures.index', compact('destinations'));
    }

    public function create() {
        // Return the view to create a new destination
        return view('admin.departures.create');
    }

    public function store(Request $request){
        // Validate the request data
        $validatedData = $request->validate([
            'destination' => 'required|string|max:255|unique:destinations,name',
        ]);

        // Create a new destination
        $destination = new \App\Models\Destination();
        $destination->name = $validatedData['destination'];
        $destination->save();

        // Redirect or return a response
        return redirect()->route('admin.departures.index')
                         ->with('success', 'Destination created successfully!');
    }

    public function edit($id) {
        // Find the destination by ID
        $destination = \App\Models\Destination::findOrFail($id);
        // Return the view to edit the destination
        return view('admin.departures.edit', compact('destination'));
    }

    public function update(Request $request, $id) {
        // Validate the request data
        $validatedData = $request->validate([
            'destination' => 'required|string|max:255|unique:destinations,name,' . $id,
        ]);

        // Find the destination by ID
        $destination = \App\Models\Destination::findOrFail($id);
        // Update the destination name
        $destination->name = $validatedData['destination'];
        $destination->save();

        // Redirect or return a response
        return redirect()->route('admin.departures.index')
                         ->with('success', 'Destination updated successfully!');
    }

    public function destroy($id) {
        // Find the destination by ID
        $destination = \App\Models\Destination::findOrFail($id);
        // Delete the destination
        $destination->delete();

        // Redirect or return a response
        return redirect()->route('admin.departures.index')
                         ->with('success', 'Destination deleted successfully!');
    }
}
