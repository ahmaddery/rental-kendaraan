<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kendaraan_id',
        'order_id',
        'purchase_date',
        'transaction_time',
        'transaction_status',
        'transaction_id',
        'status_message',
        'status_code',
        'signature_key',
        'settlement_time',
        'payment_type',
        'gross_amount',
        'fraud_status',
        'currency',
        'merchant_id',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Kendaraan model
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
}
