<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon; // Model changed
use Illuminate\Http\Request;
// File facade is removed as we are not using images

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->get(); // Variable changed
        return view('admin.coupons.index', compact('coupons')); // View and variable changed
    }

    public function create()
    {
        return view('admin.coupons.create'); // View changed
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:coupons,code|max:255',
            'type' => 'required|string|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'minimum_order_amount' => 'nullable|numeric|min:0',
            'discount_count' => 'nullable|integer|min:0',
            'expiry_date' => 'nullable|date|after:today',
            'status' => 'required|string|in:active,inactive', // 'boolean' পরিবর্তন করে 'string' করা হয়েছে
        ]);

        Coupon::create([
            'code' => $request->input('code'),
            'type' => $request->input('type'),
            'discount_value' => $request->input('discount_value'),
            'minimum_order_amount' => $request->input('minimum_order_amount'),
            'discount_count' => $request->input('discount_count'),
            'expiry_date' => $request->input('expiry_date'),
            'status' => $request->input('status', 'inactive'), // '0' পরিবর্তন করে 'inactive' করা হয়েছে
        ]);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created successfully.');
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id); // Variable changed
        return view('admin.coupons.edit', compact('coupon')); // View and variable changed
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $request->validate([
            'code' => 'required|string|max:255|unique:coupons,code,' . $coupon->id,
            'type' => 'required|string|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'minimum_order_amount' => 'nullable|numeric|min:0',
            'discount_count' => 'nullable|integer|min:0',
            'expiry_date' => 'nullable|date',
            'status' => 'required|string|in:active,inactive', // 'boolean' পরিবর্তন করে 'string' করা হয়েছে
        ]);

        // Assign text-based fields
        $coupon->code = $request->input('code');
        $coupon->type = $request->input('type');
        $coupon->discount_value = $request->input('discount_value');
        $coupon->minimum_order_amount = $request->input('minimum_order_amount');
        $coupon->discount_count = $request->input('discount_count');
        $coupon->expiry_date = $request->input('expiry_date');
        $coupon->status = $request->input('status', 'inactive'); // '0' পরিবর্তন করে 'inactive' করা হয়েছে

        $coupon->save();

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully.');
    }

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id); // Variable changed

        // Image deletion logic is removed

        $coupon->delete();

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon deleted successfully.');
    }
}
