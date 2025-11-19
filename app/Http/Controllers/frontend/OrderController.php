<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\OrderItem;





class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([

            'shipping_name' => 'required|string|max:255',
            'shipping_email' => 'required|email|max:255',
            'shipping_street_address' => 'required|string|max:255',

            'shipping_state' => 'required|string|max:100',
            'shipping_zipcode' => 'required|string|max:20',
            'shipping_country' => 'required|string|max:100',
            'payment' => 'required|in:paypal,creditcard,razorpay,bank,sslcommerz,COD',

            'billing_name' => $request->has('copy_address') ? 'required|string|max:255' : 'nullable',
            'billing_email' => $request->has('copy_address') ? 'required|email|max:255' : 'nullable',
            'billing_street_address' => $request->has('copy_address') ? 'required|string|max:255' : 'nullable',

            'billing_state' => $request->has('copy_address') ? 'required|string|max:100' : 'nullable',
            'billing_zipcode' => $request->has('copy_address') ? 'required|string|max:20' : 'nullable',
            'billing_country' => $request->has('copy_address') ? 'required|string|max:100' : 'nullable',


        ]);


        try {
            $order_number = Str::upper('ORD' . Str::random(10));
            $tracking_num = rand(100,999)."-".rand(1000,9999)."-".rand(100,999);
            $coupon_code = session()->get('coupon.code', " ");
            $discount_amount = session()->get('coupon.discount_value', 0);
            $tax_amount = session()->get('tax.rate', 0);
            $shipping_charge = session()->get('shipping.charge', 0);
            $subtotal =  session('cart') ? collect(session('cart'))->sum(fn($item) => $item['price'] * $item['quantity']) : 0;
            $grand_total = $subtotal + $tax_amount + $shipping_charge - $discount_amount;

            $payment_method = $request->payment;
            if ($payment_method !== 'COD' && $payment_method !== 'bank') {
                $status = 'paid';
            } else {
                $status = 'pending';
            }



            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => $order_number,
                'tracking_number' => $tracking_num,
                'coupon_code' => $coupon_code,
                'discounted_amount' => $discount_amount,
                'tax_amount' => $tax_amount,
                'shipping_amount' => $shipping_charge,
                'subtotal_amount' => $subtotal,
                'billing_name' => $request->has('copy_address') ? $request->billing_name : $request->shipping_name,
                'billing_email' => $request->has('copy_address') ? $request->billing_email : $request->shipping_email,

                'billing_street_address' => $request->has('copy_address') ? $request->billing_street_address : $request->shipping_street_address,
                'billing_state' => $request->has('copy_address') ? $request->billing_state : $request->shipping_state,
                'billing_zipcode' => $request->has('copy_address') ? $request->billing_zipcode : $request->shipping_zipcode,
                'billing_country' => $request->has('copy_address') ? $request->billing_country : $request->shipping_country,
                'shipping_name' => $request->shipping_name,
                'shipping_email' => $request->shipping_email,
                'shipping_street_address' => $request->shipping_street_address,
                'shipping_state' => $request->shipping_state,
                'shipping_zipcode' => $request->shipping_zipcode,
                'shipping_country' => $request->shipping_country,

                'total_amount' => $grand_total,
                'payment_method' => $payment_method,
                'payment_status' => 'pending',
                'order_status' => 'pending',
            ]);
            if($order) {
                    $cart = session()->get('cart', []);
                    foreach ($cart as $id => $item) {
                        OrderItem::create([
                            'order_id' => $order->id,
                            'product_id' => $id,
                            'quantity' => $item['quantity'],
                            'thumb' => $item['image'],
                            'price' => $item['price'],
                            'size' => $item['size'] ?? null,
                            'color' => $item['color'] ?? null,
                            'product_name' => $item['name'],
                            'total' => $item['price'] * $item['quantity'],
                        ]);
                    }
                }


        } catch (\Exception $e) {

            log::error('Order Placement Error: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Failed to place order: ' . $e->getMessage()], 500);
        } finally {
            // Clear cart and session data
            session()->forget('cart');
            session()->forget('coupon');
            session()->forget('tax');
            session()->forget('shipping');
        }


        return redirect()->route('success.store')->with('success', 'Order placed successfully!');

    }





    public function __construct()
    {
        $this->middleware('auth');
    }
}
