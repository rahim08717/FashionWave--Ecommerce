<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\product;

class WelcomeController extends Controller
{
    public function index()
    {

       $products=Product::where('status',1)->latest()->take(4)->get();
       //Trending Products
       $onsales=Product::where('status',1)->where('is_onsale',1)->latest()->take(4)->get();
       $isfeatureds=Product::where('status',1)->where('is_featured',1)->latest()->take(4)->get();
       $isbestsellers=Product::where('status',1)->where('is_best_selling',1)->latest()->take(4)->get();
       $newarrivals=Product::where('status',1)->where('is_new_arrival',1)->latest()->take(4)->get();

        $categories=Category::where('status',1)->limit(4)->orderby('id','DESC')->get();
        $sliders=DB::table('sliders')->where('status',1)->get();
        $testimonials=DB::table('testimonials')->where('status',1)->get();

        return view('welcome', compact('sliders','testimonials','categories','products','onsales','isfeatureds','isbestsellers','newarrivals'));
    }


}
