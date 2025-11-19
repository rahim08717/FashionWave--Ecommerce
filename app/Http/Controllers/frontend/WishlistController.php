<?php

namespace App\Http\Controllers\frontend;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {


    {
    if(!Auth::check())
    {
       return redirect()->route('login')->with('error', 'Please login first to compare products!');
    }
        $user = Auth::user();
        $wishlistproduct = Wishlist::where('user_id', $user->id)->with('product')->get();

        return view('front.wishlist.index', compact('wishlistproduct'));
    }




    }

    public function AddWishlist($id)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('warning', 'Please login first before adding to wishlist.');
    }

    $user = Auth::user();

    $wishlistproduct = Wishlist::where('user_id', $user->id)
                                ->where('product_id', $id);

    if ($wishlistproduct->exists()) {
        return redirect()->back()->with('info', 'Product already in your wishlist.');
    }

    Wishlist::create([
        'user_id' => $user->id,
        'product_id' => $id,
    ]);

    return redirect()->back()->with('success', 'Product added to wishlist successfully!');
}






    public function wishlistremove(Request $request)
{



        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['status' => 'success', 'message' => 'Product removed from  wishlist.']);
        }

        return response()->json(['status' => 'error', 'message' => 'Product not found in your wishlistlist.']);


}
}
