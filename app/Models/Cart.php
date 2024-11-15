<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'product_id', 'user_id', 'quantity', // tambahkan 'quantity' di sini
    ];
    
    use HasFactory;
    public function user()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function product()
    {
        return $this->hasOne('App\Models\Product','id','product_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
