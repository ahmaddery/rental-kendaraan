<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengambilanPengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengambilan_pengembalian';

    protected $fillable = [
        'user_id',
        'kendaraan_id',
        'order_id',
        'tanggal_pengambilan',
        'tanggal_pengembalian'
    ];

    // Relationship dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship dengan model Kendaraan
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }
}
