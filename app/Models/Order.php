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
        'payment',
        'status',
        'total_harga',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Product (melalui tabel pivot order_products)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    // Relasi ke Transaction
    public function transactions()
    {
        return $this->hasOne(Transaction::class, 'order_id', 'id');
    }
}
