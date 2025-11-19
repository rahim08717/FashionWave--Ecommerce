<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        return view('front.user.profile');


    }
     public function order()
    {
        // 'pending','processing','shipped','delivered','canceled'
         $orders=order::with('OrderItems')->where('user_id',Auth::id())->get();
         $deleverdOrders = order::with('OrderItems')->where('user_id',Auth::id())->where('order_status','delivered')->get();
         $canceledOrders = order::with('OrderItems')->where('user_id',Auth::id())->where('order_status','canceled')->get();
         $pendingOrders = order::with('OrderItems')->where('user_id',Auth::id())->where('order_status','pending')->get();
        return view('front.user.order',compact('orders','deleverdOrders','canceledOrders','pendingOrders'));


    }

    public function orderDetail($id)
    {
        $order = Order::with('OrderItems')->findOrFail($id);
        return view('front.user.orderDetail', compact('order'));

    }
     public function review()
    {
        $reviews=Review::with('product')->where('user_id',Auth::id())->get();

        return view('front.user.review',compact('reviews'));


    }
 public function profileEdit()
    {
        return view('front.user.profileEdit');


    }

    public function profileUpdate(Request $request)
{

    /** @var \App\Models\User $user */
     $user = Auth::user();


    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'street_address' => 'nullable|string|max:255',
        'zipcode' => 'nullable|string|max:10',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only(['name', 'email', 'street_address', 'zipcode',]);

    // Profile image upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = $user->name . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('front/assets/images/'), $filename);

        // Delete old image if exists
        if ($user->image && file_exists(public_path('front/assets/images/' . $user->image))) {
            unlink(public_path('front/assets/images/' . $user->image));
        }

        $data['image'] = $filename;
    }

    $user->update($data);

    return back()->with('success', 'Profile updated successfully!');

}
    public function Change_password(Request $request)
        {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|same:new_password',
            ]);

            $user = Auth::user();

            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('error', 'Old password does not match!');
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            return back()->with('success', 'Password changed successfully!');
        }

        public function invoice($id)
        {
            $order = Order::with('OrderItems')->findOrFail($id);
            return view('front.user.invoice', compact('order'));
        }

}
