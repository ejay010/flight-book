<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ticket extends Model
{
    //
    protected $fillable = [
        'passenger_id',// Belongs to one Passenger
        'reference_id',
        'seat_number',
        'departure_time',
        'departure_date',
        'checked_in',
        'reservation_id',// Belongs to one reservation
    ];

    function passenger() : HasOne {
        return $this->hasOne(Passenger::class);
    }

    function reservation() : HasOne {
        return $this->hasOne(Reservation::class);
    }
}
