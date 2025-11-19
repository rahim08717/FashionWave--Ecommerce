<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin; // Model changed
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash; // Required for password hashing

class AdminController extends Controller
{
    public function index()
    {
        // Get all admins except the currently logged-in one (optional, but good practice)
        $admins = Admin::latest()->get();
        return view('admin.admins.index', compact('admins')); // View and variable changed
    }

    public function create()
    {
        return view('admin.admins.create'); // View changed
    }

    public function store(Request $request)
    {
        // Validation rules updated for admin columns
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:6|confirmed',
            'status'=>'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image is optional
        ]);

        $imageName = null;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            // Image path changed
            $image->move(public_path('front/assets/images/'), $imageName);
        }

        // Create logic updated for admin columns
        Admin::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')), // Hash the password
            'image' => $imageName,
            'status' => $request->input('status', 0),
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Admin created successfully.');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id); // Variable changed
        return view('admin.admins.edit', compact('admin')); // View and variable changed
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id); // Variable changed

        // Validation rules updated for admin columns
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id, // Unique rule updated
            'password' => 'nullable|string|min:6|confirmed', // Password is optional on update
            'status'=>'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Assign text-based fields
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->status = $request->input('status', 0);

        // Handle password update only if a new password is provided
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->input('password'));
        }

        if ($request->hasFile('image')) {
            // Delete old image
            $oldImagePath = public_path('front/assets/images/admin/' . $admin->image); // Path changed
            if (file_exists($oldImagePath) && $admin->image) {
                File::delete($oldImagePath);
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('front/assets/images/'), $imageName); // Path changed
            $admin->image = $imageName; // Set the new image name
        }

        // Save all changes
        $admin->save();

        return redirect()->route('admin.admins.index')->with('success', 'Admin updated successfully.');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id); // Variable changed

        $imagepath = public_path('front/assets/images/admin/' . $admin->image); // Path changed
        if (file_exists($imagepath) && $admin->image) {
           File::delete($imagepath);
        }

        $admin->delete();

        return redirect()->route('admin.admins.index')->with('success', 'Admin deleted successfully.');
    }
}
