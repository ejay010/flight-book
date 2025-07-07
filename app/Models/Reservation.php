<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    // flight reservation model
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'birth_day',
        'phone_number',
        'trip_type',
        'departure',
        'departure_date',
        'return_date',
        'destination',
        'bag_count',
    ];
    
}
