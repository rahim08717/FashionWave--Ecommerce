<?php


namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;
use SeekableIterator;

class CouponController extends Controller
{
    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if (!$coupon) {
            return response()->json(['status' => 'error', 'message' => 'Invalid coupon code!']);
        }

        // ✅ Check if coupon is expired
        if (Carbon::now()->gt(Carbon::parse($coupon->expiry_date))) {
            return response()->json(['status' => 'error', 'message' => 'Coupon has expired!']);
        }

        // ✅ Check if coupon is active
        if ($coupon->status != 'active') {
            return response()->json(['status' => 'error', 'message' => 'Coupon is inactive!']);
        }

        // ✅ Example: apply discount
        $discountValue =  $coupon->discount_value;
        $discountType = $coupon->type;

        $message = "Coupon applied successfully! You got ";
        $message .= ($discountType == 'percentage') ? $discountValue . "% off." : "$" . $discountValue . " discount.";

        // Optional: increase usage count
        $coupon->increment('discount_count');
        
        session()->put('coupon', ['code' => $coupon->code, 'discount_value' => $discountValue,]);

        return response()->json([
            'status' => 'success',
            'message' => $message,
            'discount_type' => $discountType,
            'discount_value' => $discountValue
        ]);
        // assingn to session



    }
}
