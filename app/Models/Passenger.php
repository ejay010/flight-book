<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Passenger extends Model
{
    // The data model for a passenger
    protected $fillable = [
        'first_name',
        'last_name',
        'id_number',
        'id_type',
        'date_of_birth',
        'email',
        'phone_number',
    ];

    function bag() : HasMany {
        return $this->hasMany(Bag::class);
    }

    function reservation() : BelongsTo {
        return $this->belongsTo(Reservation::class);
    }
}
