<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XenditPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kendaraan_id',
        'external_id',
        'merchant_name',
        'merchant_profile_picture_url',
        'amount',
        'payer_email',
        'description',
        'expiry_date',
        'invoice_url',
        'status',
        'currency',
        'paid_amount',
        'bank_code',
        'paid_at',
        'payment_channel',
        'payment_destination',
        'payment_id',
        'is_high',
        'quantity', // Added quantity here
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
