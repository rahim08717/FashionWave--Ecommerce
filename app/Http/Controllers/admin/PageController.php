<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page; // মডেল পরিবর্তন
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::latest()->get(); // ভেরিয়েবল পরিবর্তন
        return view('admin.pages.index', compact('pages')); // ভিউ এবং ভেরিয়েবল পরিবর্তন
    }

    // create() ফাংশনটি বাদ দেওয়া হয়েছে

    // store() ফাংশনটি বাদ দেওয়া হয়েছে

    public function edit($id)
    {
        $page = Page::findOrFail($id); // ভেরিয়েবল পরিবর্তন
        return view('admin.pages.edit', compact('page')); // ভিউ এবং ভেরিয়েবল পরিবর্তন
    }

    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id); // ভেরিয়েবল পরিবর্তন

        // কলাম অনুযায়ী ভ্যালিডেশন পরিবর্তন
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'slug' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
        ]);

        // কলাম অনুযায়ী ভ্যালু অ্যাসাইন
        $page->title = $request->input('title');
        $page->description = $request->input('description');
        $page->slug = $request->input('slug');
        $page->meta_title = $request->input('meta_title');
        $page->meta_description = $request->input('meta_description');
        $page->meta_keyword = $request->input('meta_keyword');

        if ($request->hasFile('image')) {
            // পুরনো ইমেজ ডিলিট
            $oldImagePath = public_path('front/assets/images/page/' . $page->image); // পাথ পরিবর্তন
            if (file_exists($oldImagePath) && $page->image) {
                File::delete($oldImagePath);
            }

            // নতুন ইমেজ আপলোড
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('front/assets/images/page/'), $imageName); // পাথ পরিবর্তন
            $page->image = $imageName; // নতুন ইমেজের নাম সেট
        }

        // সব পরিবর্তন (টেক্সট এবং ইমেজ) একসাথে সেভ
        $page->save();

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy($id)
    {
        $page = Page::findOrFail($id); // ভেরিয়েবল পরিবর্তন

        $imagepath = public_path('front/assets/images/page/' . $page->image); // পাথ পরিবর্তন
        if (file_exists($imagepath) && $page->image) {
           File::delete($imagepath);
        }

        $page->delete();

        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }
}
