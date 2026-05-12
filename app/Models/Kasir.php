<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    protected $table = 'MENU';
    protected $fillable = [
        'id_menu',
        'id_kategori',
        'nama_menu',
        'deskripsi',
        'harga',
        'stok_status',
        'gambar',
    ];

}
