<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class ReviewController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|integer',
        'order_id' => 'nullable|integer',
        'rating' => 'required|integer|min:1|max:5',
        'review' => 'required|string|max:1000',
    ]);
  if(!Auth::check()){
        return redirect()->route('login')->with('error', 'You must be logged in to submit a review.');
    }

    $reviewExists = Review::where('user_id', Auth::id())
        ->where('product_id', $request->product_id)
        ->first();
    if ($reviewExists) {
        return back()->with('error', 'You have already submitted a review for this product.');
    }

    Review::create([
        'user_id' => Auth::id(),
        'order_id' => $request->order_id,
        'product_id' => $request->product_id,
        'rating' => $request->rating,
        'review' => $request->review,
    ]);

    return back()->with('success', 'Thank you! Your review has been submitted.');
}

}
