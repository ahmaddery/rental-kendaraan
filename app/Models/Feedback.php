<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kendaraan_id',
        'komentar',
        'rating',
    ];

    // Define the relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with Kendaraan model
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

     // Scope method to fetch feedback by rating
     public function scopeByRating($query, $rating)
     {
         return $query->where('rating', $rating);
     }
}
