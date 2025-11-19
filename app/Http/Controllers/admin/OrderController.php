<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $users = User::select('id', 'name', 'email')->get();
        $countries = DB::table('countries')->get(); // Assuming you have a countries table
        $states = DB::table('states')->get();       // Assuming you have a states table

        return view('admin.orders.create', compact('users', 'countries', 'states'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'billing_name' => 'required|string',
            'billing_email' => 'required|email',
            'billing_phone' => 'required|string',
            'billing_street_address' => 'required|string',
            'billing_country' => 'required',
            'billing_state' => 'required',
            'billing_zipcode' => 'required',
            'total_amount' => 'required|numeric',
        ]);

        $order = new Order();
        $order->order_number = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(4));
        $order->user_id = $request->user_id;

        // Billing
        $order->billing_name = $request->billing_name;
        $order->billing_email = $request->billing_email;
        $order->billing_phone = $request->billing_phone;
        $order->billing_street_address = $request->billing_street_address;
        $order->billing_country = $request->billing_country; // Storing ID
        $order->billing_state = $request->billing_state;     // Storing ID
        $order->billing_city = $request->billing_city;
        $order->billing_zipcode = $request->billing_zipcode;

        // Shipping (Assuming same structure)
        $order->shipping_name = $request->shipping_name ?? $request->billing_name;
        $order->shipping_email = $request->shipping_email ?? $request->billing_email;
        $order->shipping_phone = $request->shipping_phone ?? $request->billing_phone;
        $order->shipping_street_address = $request->shipping_street_address ?? $request->billing_street_address;
        $order->shipping_country = $request->shipping_country ?? $request->billing_country;
        $order->shipping_state = $request->shipping_state ?? $request->billing_state;
        $order->shipping_city = $request->shipping_city ?? $request->billing_city;
        $order->shipping_zipcode = $request->shipping_zipcode ?? $request->billing_zipcode;

        // Financials
        $order->subtotal_amount = $request->subtotal_amount ?? 0;
        $order->shipping_amount = $request->shipping_amount ?? 0;
        $order->tax_amount = $request->tax_amount ?? 0;
        $order->discounted_amount = $request->discounted_amount ?? 0;
        $order->total_amount = $request->total_amount;

        // Status
        $order->payment_method = $request->payment_method;
        $order->payment_status = $request->payment_status;
        $order->order_status = $request->order_status;
        $order->tracking_number = $request->tracking_number;

        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Order created successfully.');
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $countries = DB::table('countries')->get();
        $states = DB::table('states')->get();

        return view('admin.orders.edit', compact('order', 'countries', 'states'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'billing_name' => 'required|string',
            'order_status' => 'required',
            'payment_status' => 'required',
        ]);

        // Update Basic Info
        $order->billing_name = $request->billing_name;
        $order->billing_phone = $request->billing_phone;
        $order->billing_street_address = $request->billing_street_address;
        $order->billing_city = $request->billing_city;
        $order->billing_zipcode = $request->billing_zipcode;
        $order->billing_state = $request->billing_state;
        $order->billing_country = $request->billing_country;

        // Update Statuses
        $order->order_status = $request->order_status;
        $order->payment_status = $request->payment_status;
        $order->payment_method = $request->payment_method;
        $order->tracking_number = $request->tracking_number;

        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully.');
    }
    public function show($id)
    {
        $order = Order::with('OrderItems')->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

     public function transaction()
    {
        $transactions = Order::latest()->get();

        return view('admin.transactions.index', compact('transactions'));
    }




}
