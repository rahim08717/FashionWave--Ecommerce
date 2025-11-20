<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product; // The Product Model
use App\Models\Category; // For Category dropdown
use App\Models\Brand; // For Brand dropdown
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource. (Index/Read)
     */
    public function index()
    {
        // Fetch all products, eager loading 'category' and 'brand' relationships
        $products = Product::with(['category', 'brand'])->latest()->get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource. (Create Form)
     */
    public function create()
    {
        // Fetch data for dropdowns
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage. (Store)
     */
    public function store(Request $request)
    {
        // Validation rules
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'en_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'product_image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Image is required for creation
            'status' => 'required|boolean',
            // Add validation for other fields as needed
        ]);

        $imageName = null;

        // 1. Image Upload Logic
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('front/assets/images/products/'), $imageName);
        }

        // 2. Create the new Product record
        Product::create([
            'category_id' => $request->input('category_id'),
            'brand_id' => $request->input('brand_id'),
            'en_name' => $request->input('en_name'),
            'slug' => $request->input('slug'),
            'estimated_delivery' => $request->input('estimated_delivery'),
            'meta_title' => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
            'meta_keyword' => $request->input('meta_keyword'),
            'product_note' => $request->input('product_note'),
            'en_description' => $request->input('en_description'),
            'en_shipping' => $request->input('en_shipping'),
            'en_additional_info' => $request->input('en_additional_info'),
            'product_image' => $imageName,

            // Handle checkboxes (if unchecked, value is 0)
            'is_featured' => $request->has('is_featured') ? 1 : 0,
            'is_best_selling' => $request->has('is_best_selling') ? 1 : 0,
            'is_new_arrival' => $request->has('is_new_arrival') ? 1 : 0,
            'is_onsale' => $request->has('is_onsale') ? 1 : 0,

            'price' => $request->input('price'),
            'discount' => $request->input('discount', 0),
            // Calculate discounted price (simple example)
            // 'discounted_price' => $request->input('price') - ($request->input('discount', 0)),

            'quantity' => $request->input('quantity'),
            'status' => $request->input('status', 0),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing the specified resource. (Edit Form)
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        // Fetch data for dropdowns
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage. (Update)
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validation rules (slug uniqueness must ignore the current record)
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'en_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,'.$id,
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Image is nullable for update
            'status' => 'required|boolean',
        ]);

        $imageName = $product->product_image;

        // 1. Image Update Logic
        if ($request->hasFile('product_image')) {
            // Delete old image
            $oldImagePath = public_path('front/assets/images/products/' . $product->product_image);
            if (file_exists($oldImagePath) && $product->product_image) {
                File::delete($oldImagePath);
            }

            // Upload new image
            $image = $request->file('product_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('front/assets/images/products/'), $imageName);
        }

        // 2. Update the record
        $product->update([
            'category_id' => $request->input('category_id'),
            'brand_id' => $request->input('brand_id'),
            'en_name' => $request->input('en_name'),
            'slug' => $request->input('slug'),
            'estimated_delivery' => $request->input('estimated_delivery'),
            'meta_title' => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
            'meta_keyword' => $request->input('meta_keyword'),
            'product_note' => $request->input('product_note'),
            'en_description' => $request->input('en_description'),
            'en_shipping' => $request->input('en_shipping'),
            'en_additional_info' => $request->input('en_additional_info'),
            'product_image' => $imageName,

            // Handle checkboxes (if unchecked, value is 0)
            'is_featured' => $request->has('is_featured') ? 1 : 0,
            'is_best_selling' => $request->has('is_best_selling') ? 1 : 0,
            'is_new_arrival' => $request->has('is_new_arrival') ? 1 : 0,
            'is_onsale' => $request->has('is_onsale') ? 1 : 0,

            'price' => $request->input('price'),
            'discount' => $request->input('discount', 0),
            // 'discounted_price' => $request->input('price') - ($request->input('discount', 0)),
            'quantity' => $request->input('quantity'),
            'status' => $request->input('status', 0),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage. (Delete/Destroy)
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete associated image file
        $imagepath = public_path('front/assets/images/products/' . $product->product_image);
        if (file_exists($imagepath) && $product->product_image) {
            File::delete($imagepath);
        }

        // Delete the record
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
    public function show($id)
    {

        $product = Product::with(['category', 'brand'])->findOrFail($id);

        return view('admin.products.show', compact('product'));
    }
}
