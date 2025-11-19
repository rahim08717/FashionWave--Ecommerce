<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    // টেবিলের নাম নির্দিষ্ট করা (optional, কিন্তু ভালো অভ্যাস)
    protected $table = 'order_items';

    // কোন কোন কলাম mass assignable
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'color',
        'size',
        'quantity',
        'price',
        'total',
        'thumb',
    ];


     public function order()
     {
        return $this->belongsTo(Order::class, 'order_id');
    }



    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
   }
}
