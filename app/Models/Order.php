<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $table = 'PESANAN';
    protected $primayKey = 'ID_PESANAN';
    public $timestamps = false;
    protected $fillable = [
        'ID_USER',
        'NOMOR_MEJA',
        'TANGGAL_JAM',
        'TIPE_PESANAN',
        'TOTAL_HARGA',
        'STATUS_PESANAN'
    ];

    public function details(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'ID_PESANAN', 'ID_PESANAN');
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'ID_PESANAN', 'ID_PESANAN');
    }

    public function table(): BelongsTo
    {
        return $this->BelongsTo(Table::class, 'NOMOR_MEJA', 'NOMOR_MEJA');
    }



}
