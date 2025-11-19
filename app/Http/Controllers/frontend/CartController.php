<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;




class CartController extends Controller
{
    public function index()
    {
        return view('front.cart.index');
    }





    public function addToCart(Request $request)
    {

        $product = Product::findOrFail($request->id);

        // যদি discounted price থাকে তাহলে সেটা নেবে, না হলে normal price
        $price = $product->discounted_price ?? $product->price;
        $size = $request->size ?? null;
        $color = $request->color ?? null;

        $cart = Session::get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "id" => $product->id,
                "name" => $product->en_name,
                "slug" => $product->slug,
                "image" => $product->product_image,
                "price" => $price,
                "quantity" => 1,
                "size" => $size,
                "color" => $color
            ];
        }

        Session::put('cart', $cart);

        return response()->json([
            'status' => 'success',
            'message' => $product->en_name . ' added to cart successfully!',
            'cartCount' => $this->getCartCount(),
            'cartTotal' => $this->getCartTotal()
        ]);
    }



    private function getCartCount()
    {
        $cart = Session::get('cart', []);
        return count($cart);
    }

    private function getCartTotal()
    {
        $cart = Session::get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }


    // CartController.php
    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Item removed successfully!');
    }


    // cart incease decrease
    public function increaseQuantity(Request $request)
    {


        $cart = session()->get('cart', []);
        $id = $request->id;

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            return response()->json(['success' => true, 'quantity' => $cart[$id]['quantity']]);
        }

        return response()->json(['success' => false]);
    }

    public function decreaseQuantity(Request $request)
    {
        $cart = session()->get('cart', []);


        $id = $request->id;

        if (isset($cart[$id]) && $cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity']--;
            session()->put('cart', $cart);

            return response()->json(['success' => true, 'quantity' => $cart[$id]['quantity']]);
        }


        return response()->json(['success' => false]);
    }
public function getCartData()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'You must be logged in to view your cart.'], 401);
        }

        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->get();

        // Optional: মোট দাম যোগ করো
        $total = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });

        return response()->json([
            'items' => $cartItems,
            'total' => $total,
        ]);
    }


}
