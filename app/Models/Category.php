<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
     protected $fillable = ['en_category_name', 'en_short_info','meta_title','meta_keyword','meta_description','product_count', 'slug','description','	icon','status'];
}
