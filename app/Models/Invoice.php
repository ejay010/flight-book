<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invoice extends Model
{
    //
    protected $fillable = [
        'reservation_id',
        'reference_id',
        'status',
        'total',
        'subtotal',
        'discount',
        'bill_to_first_name',
        'bill_to_last_name',
        'bill_to_email',
        'bill_to_phone_number',
        'terms',
        'payment_link',
        'payment_method',
    ];

    function reservation() : HasOne {
        return $this->hasOne(Reservation::class);
    }
}
