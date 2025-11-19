<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; // Import Notifiable
use Illuminate\Database\Eloquent\Factories\HasFactory; // Assuming you have this

class Admin extends Authenticatable
{
    use HasFactory, Notifiable; // Add Notifiable

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'email_verified_at', 'password', 'image', 'status'
        // 'id' should not be in $fillable
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
