<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rec_address',
        'phone',
        'user_id',
        'product_id',
        'quantity',
        'payment',
        'status',
        'total_harga',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Product (satu produk per order)
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
