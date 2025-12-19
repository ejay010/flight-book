<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Flight extends Model
{
    //
    protected $fillable = [
        'destination',
        'origin',
        'date_of_departure',
        'time_of_departure',
        'tail_number',
        'status',
        'flight_number',
    ];

    function reservations() : BelongsToMany {
        return $this->belongsToMany(Reservation::class);
    }
}
