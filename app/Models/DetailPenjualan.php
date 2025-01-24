<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_penjualan',
        'id_produk',
        'JumlahProduk',
        'SubTotal',
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'id_penjualan', 'id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id');
    }
}
