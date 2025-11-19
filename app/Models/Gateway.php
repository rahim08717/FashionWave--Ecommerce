<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    use HasFactory;

    // Table name (optional, যদি table নাম 'gateways' হয় তাহলে Laravel auto detect করবে)
    protected $table = 'gateways';

    // Mass assignable fields
    protected $fillable = [
        'name',
        'credentials',
        'status',
        'mode',
    ];

    // Cast JSON column automatically to array
    protected $casts = [
        'credentials' => 'array',
        'status' => 'boolean',
    ];
}
