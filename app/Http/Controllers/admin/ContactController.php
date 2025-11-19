<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function contacts()
    {
        // Logic to retrieve and display all contacts
        $contacts =DB::table('contacts')->latest()->get();
        return view('admin.contacts',compact('contacts'));
    }
    public function viewContact($id)
    {
        $contact = DB::table('contacts')->where('id', $id)->first();
        if(!$contact){
            return redirect()->route('admin.contacts')->with('error', 'Contact not found.');
        }
        return view('admin.view_contact', compact('contact'));
        // Logic to view a specific contact by ID
    }
   public function destroy($id)
{
    // Query Builder-এর delete মেথডটি এভাবে কল করতে হয়
    DB::table('contacts')->where('id', $id)->delete();

    return redirect()->back()->with('success', 'Contact deleted successfully!');
}


}
