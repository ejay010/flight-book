<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Reservation extends Model
{
    // flight reservation model
    protected $fillable = [
        'contact_first_name',
        'contact_last_name',
        'contact_email',
        'contact_phone_number',
        'reference_number',
        'round_trip',
        'status'
    ];

    // Reservation has many flights
    function flights() : BelongsToMany {
        return $this->belongsToMany(Flight::class);
    }

    // Reservation has many passengers
    function passengers() : HasMany {
        return $this->hasMany(Passenger::class);
    }
}
