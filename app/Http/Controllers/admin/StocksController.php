<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;

class StocksController extends Controller
{
        public function index()
    {
        // Load all stock entries, ordering by the latest first.
        // Eager load the 'ProductName' relationship to avoid N+1 query issue.
        $stocks = Stock::with('ProductName')->latest()->get();

        // Pass the stocks data to the index view.
        return view('admin.stocks.index', compact('stocks'));
    }

    public function currentStock()
{
    // Get all products with category and stock calculations
    $products = Product::with('category')
        ->withSum(['stocks as stock_in' => function ($query) {
            $query->where('stock_type', 'in');
        }], 'quantity')
        ->withSum(['stocks as stock_out' => function ($query) {
            $query->where('stock_type', 'out');
        }], 'quantity')
        ->get();

    // Calculate current stock
    foreach ($products as $product) {

        $stockIn  = $product->stock_in ?? 0;
        $stockOut = $product->stock_out ?? 0;

        $product->current_stock = $stockIn - $stockOut;
    }

    // Separate low stock & ok stock products
    $lowStockProducts = [];
    $okStockProducts  = [];

    foreach ($products as $product) {

        // যদি min_stock টেবিলে থাকে, সেটাই ব্যবহার করবো
        $minStock = $product->min_stock ?? 0;

        if ($product->current_stock <= $minStock) {
            $lowStockProducts[] = $product;
        } else {
            $okStockProducts[] = $product;
        }
    }

    // merge করে Low Stock প্রথমে, তারপর OK Stock
    $sortedProducts = array_merge($lowStockProducts, $okStockProducts);

    return view('admin.stocks.current_stock', [
        'products' => $sortedProducts
    ]);
}



}
