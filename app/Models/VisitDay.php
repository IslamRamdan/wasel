<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitDay extends Model
{
    protected $fillable = [
        'booking_id',
        'city',
        'hotel_index',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    // ================= العلاقات =================

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
