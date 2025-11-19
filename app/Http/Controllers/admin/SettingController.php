<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting; // Use the Setting model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    /**
     * Show the edit form for settings.
     * It finds the setting with id=1, or creates it if it doesn't exist.
     */
    public function edit()
    {
        // Find the setting with id=1, or create a new one if it doesn't exist
        $setting = Setting::firstOrCreate(['id' => 1]);
        return view('admin.setting.edit', compact('setting'));
    }

    /**
     * Update the settings in the database.
     */
    public function update(Request $request)
    {
        // Find the setting (id=1)
        $setting = Setting::firstOrCreate(['id' => 1]);

        // Validate the incoming request data
        $request->validate([
            'site_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'fb' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkdin' => 'nullable|url',
            'youtube' => 'nullable|url',
            'map_ifram' => 'nullable|string',
            'copyright' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:png,ico|max:512',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Assign all text-based fields
        $setting->site_name = $request->input('site_name');
        $setting->phone = $request->input('phone');
        $setting->email = $request->input('email');
        $setting->address = $request->input('address');
        $setting->fb = $request->input('fb');
        $setting->twitter = $request->input('twitter');
        $setting->linkdin = $request->input('linkdin');
        $setting->youtube = $request->input('youtube');
        $setting->map_ifram = $request->input('map_ifram');
        $setting->copyright = $request->input('copyright');
        $setting->meta_title = $request->input('meta_title');
        $setting->meta_description = $request->input('meta_description');
        $setting->meta_keyword = $request->input('meta_keyword');


        // --- Image Upload Logic (Path Fixed) ---

        // 1. Handle Logo Upload
        if ($request->hasFile('logo')) {
            // Delete old image if it exists
            // Path fixed: removed 'setting/' folder
            $oldImagePath = public_path('front/assets/images/' . $setting->logo);
            if (file_exists($oldImagePath) && $setting->logo) {
                File::delete($oldImagePath);
            }

            // Upload new image
            $image = $request->file('logo');
            // We use a fixed name for settings images, not time()
            $imageName = 'logo.' . $image->getClientOriginalExtension();
            // Path fixed: removed 'setting/' folder
            $image->move(public_path('front/assets/images/'), $imageName);
            $setting->logo = $imageName; // Set the new image name on the model
        }

        // 2. Handle Favicon Upload
        if ($request->hasFile('favicon')) {
            // Delete old image if it exists
            // Path fixed: removed 'setting/' folder
            $oldImagePath = public_path('front/assets/images/' . $setting->favicon);
            if (file_exists($oldImagePath) && $setting->favicon) {
                File::delete($oldImagePath);
            }

            // Upload new image
            $image = $request->file('favicon');
            $imageName = 'favicon.' . $image->getClientOriginalExtension();
            // Path fixed: removed 'setting/' folder
            $image->move(public_path('front/assets/images/'), $imageName);
            $setting->favicon = $imageName; // Set the new image name on the model
        }

        // 3. Handle OG Image Upload
        if ($request->hasFile('og_image')) {
            // Delete old image if it exists
            // Path fixed: removed 'setting/' folder
            $oldImagePath = public_path('front/assets/images/' . $setting->og_image);
            if (file_exists($oldImagePath) && $setting->og_image) {
                File::delete($oldImagePath);
            }

            // Upload new image
            $image = $request->file('og_image');
            $imageName = 'og_image.' . $image->getClientOriginalExtension();
            // Path fixed: removed 'setting/' folder
            $image->move(public_path('front/assets/images/'), $imageName);
            $setting->og_image = $imageName; // Set the new image name on the model
        }

        // --- End of Image Logic ---

        // Save all changes (text fields and images) to the database
        $setting->save();

        // Redirect back to the edit page with a success message
        return redirect()->route('admin.setting.edit')->with('success', 'Settings updated successfully.');
    }
}
