<?php

use App\Models\Compare;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Order;
use App\Models\Wishlist;
use App\Models\Stock;

if (! function_exists('getCurrentStock')) {

    function getCurrentStock($productId)
    {
        // Total stock in
        $stockIn = Stock::where('product_id', $productId)
            ->where('stock_type', 'in')
            ->sum('quantity');

        // Total stock out
        $stockOut = Stock::where('product_id', $productId)
            ->where('stock_type', 'out')
            ->sum('quantity');

        // Final stock
        return $stockIn - $stockOut;
    }
}

if (!function_exists('getSetting')) {
    function getSetting($key = null)
    {
        $settings = Cache::remember('site_settings', 60 * 60, function () {
            return DB::table('settings')->first(); // stdClass
        });

        // key দেওয়া হলে property return করা
        if ($key && isset($settings->{$key})) {
            return $settings->{$key}; // ✅ string
        }

        return $settings;
    }
}
if (!function_exists('getCategories')) {
    function getCategories()
    {
        // 60 মিনিটের জন্য ক্যাশে রাখবো
        return Cache::remember('categories_list', 60, function () {
            return Category::select('id', 'en_category_name', 'slug')
                ->orderBy('en_category_name')
                ->get();
        });
    }


    if (!function_exists('compareCount')) {
        function compareCount()
        {
            // ✅ যদি user login করা থাকে
            if (Auth::check()) {
                return Compare::where('user_id', Auth::id())->count();
            }

            return 0;
        }
    }

    if (!function_exists('wishlistCount')) {
        function wishlistCount()
        {
            // ✅ যদি user login করা থাকে
            if (Auth::check()) {
                return Wishlist::where('user_id', Auth::id())->count();
            }

            return 0;
        }
    }

    if (!function_exists('pendingstatus')) {
        function pendingstatus($status)
        {
            return Order::where('user_id', Auth::id())->where('order_status', $status)->count();
        }
    }
    if (!function_exists('processingstatus')) {
        function processingstatus($status)
        {
            return Order::where('user_id', Auth::id())->where('order_status', $status)->count();
        }
    }
    if (!function_exists('shippedstatus')) {
        function shippedstatus($status)
        {
            return Order::where('user_id', Auth::id())->where('order_status', $status)->count();
        }
    }
    if (!function_exists('deliveredstatus')) {
        function deliveredstatus($status)
        {
            return Order::where('user_id', Auth::id())->where('order_status', $status)->count();
        }
    }
    if (!function_exists('cancelledstatus')) {
        function cancelledstatus($status)
        {
            return Order::where('user_id', Auth::id())->where('order_status', $status)->count();
        }
    }
}
