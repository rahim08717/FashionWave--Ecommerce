<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;

class StatesController extends Controller
{
    /**
     * Display a listing of the states.
     */
    public function index()
    {
        // Get all states, latest first
        $states = State::latest()->get();
        return view('admin.states.index', compact('states'));
    }

    /**
     * Show the form for creating a new state.
     */
    public function create()
    {
        $countries=Country::latest()->get();

        return view('admin.states.create',compact('countries'));
    }

    /**
     * Store a newly created state in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'country_id'     => 'required|integer', // adjust this rule if you have a countries table
            'name'           => 'required|string|max:255',
            'shipping_charge'=> 'required|numeric|min:0',
        ]);

        // Create the new State record
        State::create([
            'country_id'     => $request->input('country_id'),
            'name'           => $request->input('name'),
            'shipping_charge'=> $request->input('shipping_charge'),
        ]);

        // Redirect to index with success message
        return redirect()->route('admin.states.index')
            ->with('success', 'State created successfully.');
    }

    /**
     * Show the form for editing the specified state.
     */
    public function edit($id)
    {
        $state = State::findOrFail($id);
        $countries = Country::all(); // dropdown er jonno

    return view('admin.states.edit', compact('state', 'countries'));

    }

    /**
     * Update the specified state in storage.
     */
    public function update(Request $request, $id)
    {
        $state = State::findOrFail($id);

        // Validate input
        $request->validate([
            'country_id'     => 'required|integer',
            'name'           => 'required|string|max:255',
            'shipping_charge'=> 'required|numeric|min:0',
        ]);

        // Update state data
        $state->update([
            'country_id'     => $request->input('country_id'),
            'name'           => $request->input('name'),
            'shipping_charge'=> $request->input('shipping_charge'),
        ]);

        // Redirect after update
        return redirect()->route('admin.states.index')
            ->with('success', 'State updated successfully.');
    }

    /**
     * Remove the specified state from storage.
     */
    public function destroy($id)
    {
        $state = State::findOrFail($id);
        $state->delete();

        return redirect()->route('admin.states.index')
            ->with('success', 'State deleted successfully.');
    }
}
