<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\OrderItem;





class OrderTrackingController extends Controller
{
    public function ordertracking($tracking_number)
    {
       $order=Order::with('OrderItems')->where('tracking_number',$tracking_number)->first();

    if (!$order) {
        return redirect()->back()->with('error', 'Invalid tracking number!');
    }
       return view('front.tracking.index',compact('order'));
    }
    public function store(Request $request)
    {

}

}
