<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // kolom yang boleh diisi lewat form
    protected $fillable = ['nama_barang', 'harga', 'stok', 'deskripsi'];
}
