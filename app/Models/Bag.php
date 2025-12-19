<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bag extends Model
{
    //
    protected $fillable = [
        'weight',
        'checked',
        'carryon',
        'type',
    ];

    function passenger() : BelongsTo {
        return $this->belongsTo(Passenger::class);
    }
}
