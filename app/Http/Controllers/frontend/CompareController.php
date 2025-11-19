<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Compare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class CompareController extends Controller
{

    public function index()


    {
    if(!Auth::check())
    {
       return redirect()->route('login')->with('error', 'Please login first to compare products!');
    }
        $user = Auth::user();
        $compareproduct = Compare::where('user_id', $user->id)->with('product')->get();

        return view('front.compare.index', compact('compareproduct'));
    }


    public function AddToCompare($id)
    {
        // ✅ User login check
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Please login first to compare products!');
        }

        $user = Auth::user();

        // ✅ Check if already exists
        $exists = Compare::where('user_id', $user->id)
            ->where('product_id', $id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('info', 'This product is already in your compare list!');
        }

        // ✅ Count user's current compare items
        $count = Compare::where('user_id', $user->id)->count();

        if ($count >= 2) {
            return redirect()->back()->with('warning', 'You can compare only 2 products at a time!');
        }

        // ✅ Save to database
        Compare::create([
            'user_id' => $user->id,
            'product_id' => $id,
        ]);

        return redirect()->back()->with('success', 'Product added to compare list successfully!');
    }



    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
        ]);

        Compare::create($request->all());

        return redirect()->route('compare.index')
            ->with('success', 'Product added to compare list.');
    }

  

   public function removeCompare(Request $request)
{



        $compare = Compare::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($compare) {
            $compare->delete();
            return response()->json(['status' => 'success', 'message' => 'Product removed from compare list.']);
        }

        return response()->json(['status' => 'error', 'message' => 'Product not found in your compare list.']);


}


}
