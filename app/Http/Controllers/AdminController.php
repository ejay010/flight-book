<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Controller methods for the admin panel can be added here

    //create an Administrator
    public function createAdmin() {
        // Show the form to create an admin
        return view('admin.create');
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
}
