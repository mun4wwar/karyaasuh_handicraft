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
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function decrementStock($quantity)
    {
        if ($this->stock < $quantity) {
            throw new \Exception("Stok tidak cukup untuk produk {$this->title}");
        }

        $this->stock -= $quantity;
        $this->save();
    }
}
