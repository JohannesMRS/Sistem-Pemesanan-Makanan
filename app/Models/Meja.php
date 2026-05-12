<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    protected $table = 'MEJA';

    protected $fillable = [
        'nomor_meja',
        'kapasitas',
        'status_meja'
    ];
}
