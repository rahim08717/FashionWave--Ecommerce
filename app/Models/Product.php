<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'description', 'image'];

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

