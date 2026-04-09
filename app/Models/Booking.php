<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $fillable = [
        'supervisor_name',
        'supervisor_phone_sa',
        'supervisor_phone_eg',
        'company',
        'external_agent_name',
        'agent_country',
        'bus_type',
        'passengers',
        'buses',
        'tourism_company_id',
        'price',
        'status',
    ];
    public function flights()
    {
        return $this->hasMany(Flight::class);
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    public function transfers()
    {
        return $this->hasMany(Transfer::class);
    }

    public function visitDays()
    {
        return $this->hasMany(VisitDay::class);
    }
}
