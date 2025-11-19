<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['code', 'discount_value','type', 'expiry_date','minimum_order_amount','status','discount_count'];


    protected $casts = [
        'expiry_date' => 'date', 
    ];
}
