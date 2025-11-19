<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gateway; // Model changed
use Illuminate\Http\Request;
// File facade is removed (no images)

class GatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gateways = Gateway::latest()->get(); // Variable changed
        return view('admin.gateways.index', compact('gateways')); // View and variable changed
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $gateway = Gateway::findOrFail($id); // Variable changed
        return view('admin.gateways.edit', compact('gateway')); // View and variable changed
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $gateway = Gateway::findOrFail($id); // Variable changed

        // Validation rules updated for gateway columns
        $request->validate([
            'name' => 'required|string|max:255',
            'credentials' => 'required|array', // Validates that 'credentials' is an array
            'credentials.*' => 'nullable|string', // Validates each item inside the array
            'status' => 'required|boolean',
            'mode' => 'required|boolean'

        ]);

        // Assign fields
        $gateway->name = $request->input('name');
        $gateway->credentials = $request->input('credentials'); // Saves the array as JSON (due to $casts)
        $gateway->status = $request->input('status', 0);
        $gateway->status = $request->input('mode');

        // No image logic

        // Save all changes
        $gateway->save();

        // Redirect back to the index page
        return redirect()->route('admin.gateways.index')->with('success', 'Gateway updated successfully.');
    }

    // create(), store(), and destroy() functions are removed
}
