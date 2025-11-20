<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
  
    public function index()
    {
        // Fetch all suppliers, ordered by the latest first
        $suppliers = Supplier::latest()->get();

        // Pass the data to the index view
        return view('admin.suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource. (Create Form)
     */
    public function create()
    {
        return view('admin.suppliers.create');
    }

    /**
     * Store a newly created resource in storage. (Store)
     */
    public function store(Request $request)
    {
        // Validation rules
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:suppliers,email', // Email is optional but if present, must be unique
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        // Create a new Supplier record
        Supplier::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier created successfully.');
    }

    /**
     * Show the form for editing the specified resource. (Edit Form)
     */
    public function edit($id)
    {
        // Find the record or fail
        $supplier = Supplier::findOrFail($id);
        return view('admin.suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage. (Update)
     */
    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        // Validation rules (Email uniqueness must ignore the current record)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:suppliers,email,'.$id, // Ignore current ID for unique check
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        // Update the record
        $supplier->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    /**
     * Remove the specified resource from storage. (Delete/Destroy)
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        // Delete the record
        $supplier->delete();

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}
