<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'TanggalPenjualan',
        'TotalHarga',
        'id_pelanggan',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id');
    }

    public function details()
    {
        return $this->hasMany(DetailPenjualan::class, 'id_penjualan', 'id');
    }
}
