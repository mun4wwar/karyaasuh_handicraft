<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'category',
        'stock',
        'price', // Tambahkan atribut 'price' jika belum ada
    ];

    // Relasi ke Order (satu produk dapat memiliki banyak order)
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    // Method untuk mengurangi stok
    public function decrementStock($quantity)
    {
        if ($this->stock < $quantity) {
            throw new \Exception("Stok tidak cukup untuk produk {$this->title}");
        }

        $this->stock -= $quantity;
        $this->save();
    }
    // Di dalam Product.php (App\Models\Product)
    public function materials()
    {
        return $this->belongsTo(Bahanbaku::class, 'bahan_baku_id');
    }
}
