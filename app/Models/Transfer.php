<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $fillable = [
        'booking_id',
        'from',
        'to',
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
