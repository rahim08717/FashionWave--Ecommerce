<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->get();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'status'=>'required|boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = null;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $image->move(public_path('front/assets/images/brand/'), $imageName);
        }

        Brand::create([
            'en_brand_name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'image' => $imageName,
            'status' => $request->input('status', 0),
        ]);

        return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully.');
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'status'=>'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $brand->en_brand_name = $request->input('name');
        $brand->slug = $request->input('slug');

        $brand->status = $request->input('status', 0);

        if ($request->hasFile('image')) {
            //old image delete
            $oldImagePath = public_path('front/assets/images/brand/' . $brand->image);
            if (file_exists($oldImagePath) && $brand->image) {
                File::delete($oldImagePath);
            }

            // new image upload
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('front/assets/images/brand/'), $imageName);
            $brand->image = $imageName;
        }


        $brand->save();

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully.');
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        $imagepath = public_path('front/assets/images/brand/' . $brand->image);
        if (file_exists($imagepath) && $brand->image) {
           File::delete($imagepath);
        }

        $brand->delete();

        return redirect()->route('admin.brands.index')->with('success', 'Brand deleted successfully.');
    }
}
