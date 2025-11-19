<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonial = Testimonial::latest()->get();

        return view('admin.testimonial.index', compact('testimonial'));
    }

    public function create()
    {

        return view('admin.testimonial.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'profession' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'boolean',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('front/assets/images/'), $imageName);
        }
        Testimonial::create([
            'name' => $request->input('name'),
            'profession' => $request->input('profession'),
            'description' => $request->input('description'),
            'image' => $imageName,
            'status' => $request->input('status', 0),
        ]);



        return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial created successfully.');
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonial.edit', compact('testimonial'));
    }
    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $request->validate([
            'name' => 'string|max:255',
            'profession' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'boolean',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        if ($request->hasFile('image')) {
            // Delete old image
            $oldImagePath = public_path('front/assets/images/' . $testimonial->image);
            if (file_exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('front/assets/images/'), $imageName);
            $testimonial->image = $imageName;
        }

        $testimonial->update([
            'name' => $request->input('name'),
            'profession' => $request->input('profession'),
            'description' => $request->input('description'),
            'status' => $request->input('status', 0),
        ]);


        return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial updated successfully.');
    }
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $imagepath = public_path('front/assets/images/' . $testimonial->image);
        if (file_exists($imagepath)) {
            File::delete($imagepath);
        }
        $testimonial->delete();

        return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial deleted successfully.');
    }
}
