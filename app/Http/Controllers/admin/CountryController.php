<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::latest()->get();

        return view('admin.countries.index', compact('countries'));
    }

    public function create()
    {

        return view('admin.countries.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'vat_tax' => 'required|string',

        ]);

        Country::create([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'vat_tax' => $request->input('vat_tax'),

        ]);



        return redirect()->route('admin.countries.index')->with('success', 'Vat created successfully.');
    }

    public function edit($id)
    {
        $countries = Country::findOrFail($id);
        return view('admin.countries.edit', compact('countries'));
    }
    public function update(Request $request, $id)
    {
        $countries = Country::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'vat_tax' => 'required|string',
        ]);




       $countries->update([
             'name' => $request->input('name'),
            'code' => $request->input('code'),
            'vat_tax' => $request->input('vat_tax'),

        ]);

        return redirect()->route('admin.countries.index')->with('success', 'country updated successfully.');
    }
    public function destroy($id)
    {
        $countries = Country::findOrFail($id);

        $countries->delete();

        return redirect()->route('admin.countries.index')->with('success', 'Country deleted successfully.');
    }


}
