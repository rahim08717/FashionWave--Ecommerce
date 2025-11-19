<?php

namespace App\Models;

use App\Models\OrderItem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
    'user_id',
    'order_number',
    'billing_name',
    'billing_email',
    'billing_phone',
    'billing_street_address',
    'billing_city',
    'billing_state',
    'billing_zipcode',
    'billing_country',
    'shipping_name',
    'shipping_email',
    'shipping_phone',
    'shipping_street_address',
    'shipping_city',
    'shipping_state',
    'shipping_zipcode',
    'shipping_country',
    'total_amount',
    'payment_method',
    'payment_status',
    'order_status',
    'coupon_code',
    'discounted_amount',
    'tax_amount',
    'shipping_amount',
    'subtotal_amount',
    'tracking_number'
];
public function OrderItems()
{
    return $this->hasMany(OrderItem::class);
}

public function BillingCountry()
{
    return $this->belongsTo(Country::class,'billing_country');
}

public function ShippingCountry()
{
    return $this->belongsTo(Country::class,'shipping_country');
}

public function BillingState()
{
    return $this->belongsTo(State::class,'billing_state');
}
public function ShippingState()
{
    return $this->belongsTo(State::class,'shipping_state');
}

public function  user()
{
    return $this->belongsTo(User::class,'user_id');
}


}
