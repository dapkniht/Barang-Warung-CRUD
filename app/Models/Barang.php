<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = "barang";
    protected $fillable = [
        "nama_barang",
        "harga",
        "stok",
        "kategori_id",
        "created_at",
        "updated_at"
    ];

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }
}
