<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::latest()->get();

        return view('admin.category.index', compact('category'));
    }

    public function create()
    {

        return view('admin.category.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|max:255',
            'short_info' => 'nullable|string|max:255',
            'slug' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'boolean',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $iconName = null;

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $iconName = time() . '.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('front/assets/images/'), $iconName);
        }
        Category::create([
            'en_category_name' => $request->input('name'),
            'en_short_info' => $request->input('short_info'),
            'slug' => $request->input('slug'),
            'meta_title' => $request->input('meta_title'),
            'meta_keyword' => $request->input('meta_keyword'),
            'meta_description' => $request->input('meta_description'),
            'description' => $request->input('description'),
            'icon' => $iconName,
            'status' => $request->input('status', 0),
        ]);



        return redirect()->route('admin.category.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'string|max:255',
            'short_info' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'boolean',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 'icon' ভ্যালিডেশন ঠিক আছে
        ]);

        
        $category->en_category_name = $request->input('name');
        $category->en_short_info = $request->input('short_info');
        $category->meta_title = $request->input('meta_title');
        $category->meta_keyword = $request->input('meta_keyword');
        $category->meta_description = $request->input('meta_description');
        $category->description = $request->input('description');
        $category->status = $request->input('status', 0);


        if ($request->hasFile('icon')) {

            if ($category->icon) {
                $oldImagePath = public_path('front/assets/images/' . $category->icon);
                if (file_exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }


            $icon = $request->file('icon');
            $iconName = time() . '.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('front/assets/images/'), $iconName);

            $category->icon = $iconName;
        }


        $category->save();

        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully.');
    }
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $iconpath = public_path('front/assets/images/' . $category->icon);
        if (file_exists($iconpath)) {
            File::delete($iconpath);
        }
        $category->delete();

        return redirect()->route('admin.category.index')->with('success', 'Category deleted successfully.');
    }
}
