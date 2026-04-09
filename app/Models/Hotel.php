<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'booking_id',
        'city',
        'name',
        'address',
        'checkin',
        'checkout',
    ];

    protected $casts = [
        'checkin' => 'date',
        'checkout' => 'date',
    ];

    // ================= العلاقات =================

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
