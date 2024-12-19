<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahanbaku extends Model
{
    use HasFactory;

    protected $table = 'materials';
    protected $primaryKey = 'id_bahanbaku';
    protected $fillable = [
        'nama_bahan',
        'jumlah_bahan',
        'satuan',
        'harga_bahan',
    ];

    // Di dalam Material.php (App\Models\Material)
    public function products()
    {
        return $this->hasMany(Product::class, 'bahan_baku_id');
    }
}
