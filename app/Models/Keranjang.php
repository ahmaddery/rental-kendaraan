<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjang';

    protected $fillable = [
        'user_id',
        'kendaraan_id',
        'quantity',
    ];

    // Definisikan relasi antara model Keranjang dan model Kendaraan
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    // Definisikan relasi antara model Keranjang dan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
