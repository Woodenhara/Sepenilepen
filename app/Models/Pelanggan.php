<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'NamaPelanggan',
        'Alamat',
        'NomorTelepon',
    ];

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'id_pelanggan', 'id');
    }

}
