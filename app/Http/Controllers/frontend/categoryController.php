<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\page;
class categoryController extends Controller
{
    public function index()
    {
        $data=page::where('slug','category')->first();
        $categories=Category::where('status',1)->orderby('id','DESC')->get();
        return view('front.category.index', compact('categories','data'));
    }


}
