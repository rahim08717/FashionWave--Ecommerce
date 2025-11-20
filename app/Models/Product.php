<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'category_id', 'brand_id', 'en_name','slug', 'estimated_delivery', 'meta_title', 'meta_description','meta_keyword', 'product_note', 'en_description', 'en_shipping','en_additional_info', 'product_image', 	'is_featured', 'is_best_selling','is_new_arrival', 'is_onsale', 'price', 'discount', 'quantity', '	status'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');

    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');

    }
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_product', 'product_id');
    }
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'size_product', 'product_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }
}

