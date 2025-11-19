<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::latest()->get();
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        // Status validation removed
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'street_address' => 'nullable|string|max:255',
            'zipcode' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('front/assets/images/'), $imageName);
        }

        $customer = new User();
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->password = $request->input('password'); // Auto hashed by model casts
        $customer->street_address = $request->input('street_address');
        $customer->zipcode = $request->input('zipcode');
        // Status assignment removed
        $customer->image = $imageName;
        $customer->save();

        return redirect()->route('admin.customers.index')->with('success', 'Customer created successfully.');
    }

    public function edit($id)
    {
        $customer = User::findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = User::findOrFail($id);

        // Status validation removed
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $customer->id,
            'password' => 'nullable|string|min:6|confirmed',
            'street_address' => 'nullable|string|max:255',
            'zipcode' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->street_address = $request->input('street_address');
        $customer->zipcode = $request->input('zipcode');
        // Status assignment removed

        if ($request->filled('password')) {
            $customer->password = $request->input('password');
        }

        if ($request->hasFile('image')) {
            $oldImagePath = public_path('front/assets/images/' . $customer->image);
            if (file_exists($oldImagePath) && $customer->image) {
                File::delete($oldImagePath);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('front/assets/images/'), $imageName);
            $customer->image = $imageName;
        }

        $customer->save();

        return redirect()->route('admin.customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
        $customer = User::findOrFail($id);

        $imagepath = public_path('front/assets/images/' . $customer->image);
        if (file_exists($imagepath) && $customer->image) {
           File::delete($imagepath);
        }

        $customer->delete();

        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted successfully.');
    }
}
