<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $fillable = [
        'booking_id',
        'type',
        'airline',
        'flight_no',
        'from_airport',
        'to_airport',
        'terminal',
        'date',
        'time',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i',
    ];

    // ================= العلاقات =================

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
