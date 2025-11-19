<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Checkout;
use App\Models\Gateway;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CheckoutController extends Controller
{

    public function index(request $request)
    {
        $countries = DB::table('countries')->get();
        $gateways = Gateway::all()->keyBy('name');

        return view('front.checkout.index', compact('countries','gateways'));
    }
    public function getStates($country_id)
    {
        $states = DB::table('states')->where('country_id', $country_id)->get();
        return response()->json($states);
    }

    public function getCountryVat($id)
    {
        $country = DB::table('countries')->where('id', $id)->first();
        $subtotal =  session('cart') ? collect(session('cart'))->sum(fn($item) => $item['price'] * $item['quantity']) : 0;
        $countryvat = ($country->vat_tax / 100) * $subtotal;

        session()->put('tax', ['rate' => $countryvat]);

        if ($country) {
            return response()->json([
                'vat_tax' => $countryvat

            ]);
        } else {
            return response()->json([
                'vat_tax' => 0
            ]);
        }
    }


    public function getShippingCharge($id)
    {
        $state = DB::table('states')->where('id', $id)->first();
        session()->put('shipping', ['charge' => $state->shipping_charge]);

        if ($state) {
            return response()->json([
                'shipping_charge' => $state->shipping_charge
            ]);
        } else {
            return response()->json([
                'shipping_charge' => 0
            ]);
        }
    }

    public function success(Request $request)
    {
        return view('front.checkout.success');
    }
}
