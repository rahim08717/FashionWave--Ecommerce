<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\page;
use App\Models\color;
use App\Models\size;
use App\Models\Review;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $data = Page::where('slug', 'shop')->first();
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $colors = color::all();
        $sizes = size::all();

        $query = Product::where('status', 1);

        // ✅ Search filter (যদি search keyword থাকে)
        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('en_name', 'like', "%{$keyword}%")
                    ->orWhere('en_description', 'like', "%{$keyword}%")
                    ->orWhere('slug', 'like', "%{$keyword}%");
            });
        }

        // ✅ Price range filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('category')) {
            $query->where('category_id', '>=', $request->category);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // ✅ Paginate the final results
        $products = $query->paginate(6);

        return view('front.product.index', compact('categories', 'brands', 'products', 'data', 'colors', 'sizes'));
    }


    public function product_detail($slug)
    {

        $has_order = false;
        $order_id = null;

        $product = Product::with('colors')->with('sizes')->with('reviews')->where('slug', $slug)->firstOrFail();

        $OrderItem = OrderItem::where('product_id', $product->id)->whereHas('order', function ($q) {
            $q->where('user_id', Auth::id());
        })->first();
        if ($OrderItem) {
            $has_order = true;
            $order_id = $OrderItem->order_id;
        }

        $average_rating = $product->reviews()->avg('rating') ?? 0;
        $average_rating = round($average_rating, 1);

        $related_products = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        $images = DB::table('galleries')->where('product_id', $product->id)->get();





        return view('front.product.detail', compact('product', 'related_products', 'images', 'has_order', 'order_id', 'average_rating'));
    }


    public function category_product($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $sizes = size::all();
        $colors = color::all();
        $products = Product::where('category_id', $category->id)
            ->where('status', 1)
            ->paginate(6);


        return view('front.product.products_category', compact('category', 'products', 'categories', 'brands', 'sizes', 'colors'));
    }
    // public function show($id)
    // {
    //     return view('products.show', [
    //         'product' => Product::findOrFail($id)
    //     ]);
    // }

    // public function create()
    // {
    //     return view('products.create');
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name'  => 'required|string|max:255',
    //         'price' => 'required|numeric',
    //     ]);

    //     Product::create($request->all());

    //     return redirect()->route('products.index')
    //                      ->with('success', 'Product added successfully.');
    // }
}
