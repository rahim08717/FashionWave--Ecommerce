<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'supplier_id',
        'total_amount',
        'purchases_date',
        'notes'
    ];
    protected $casts = [
    'purchases_date' => 'datetime',

];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }

    public function items()
    {
        return $this->hasMany(PurchaseItem::class,'purchase_id');
    }


}
