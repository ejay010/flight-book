<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Reservation extends Model
{
    // flight reservation model
    protected $fillable = [
        'primary_contact',
        'trip_type',
        'departure',
        'departure_date',
        'return_date',
        'destination',
        'passenger_count',
        'passengers',
        'confirmation',
        'payment_status',
        'reference_number',
    ];
    
    protected function casts(): array
    {
        return [
            'passengers' => 'array',
            'primary_contact' => 'array',
        ];
    }

    protected function referenceNumber(): Attribute
    {
        return Attribute::make(
            set: function (string $value) {
                // Generate a unique reference number
                return uniqid('IIC-');
            }
        );
    }

    protected function primaryContact(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                // Ensure primary contact is always an array
                return json_decode($value);
            }
        );
    }

    protected function passengers(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                // Ensure passengers is always an array
                return Collection::fromJson($value);
            }
        );
    }

    protected function baggageCount(): Attribute
    {
        return Attribute::make(
            get: function ($value, array $attributes) {
                // get the baggage count from passengers
                $passengers = json_decode($attributes['passengers'], true);
                $baggageCount = 0;  
                foreach ($passengers as $passenger) {
                    if (isset($passenger['bag_count'])) {
                        $baggageCount += (int) $passenger['bag_count'];
                    }
                }
                // Ensure baggage count is always an integer
                return (int) $baggageCount;
            }
        );
    }

    protected function totalPrice(): Attribute
    {
        return Attribute::make(
            get: function ($value, array $attributes) {
                // Calculate the total price based on passengers and trip type
                $passengers = json_decode($attributes['passengers'], true);
                
                $adultPassengers = array_filter($passengers, function ($passenger) {
                    return $passenger['is_child'] === "0";
                });
                $childPassengers = array_filter($passengers, function ($passenger) {
                    return $passenger['is_child'] === "1";
                });
                $baggageCost = 35; // Example baggage price per bag
                $baggageCount = $this->baggageCount ?? 0;
                $baggagePrice = $baggageCount * $baggageCost;
                $adultPrice = 160; // Example base price per adult passenger
                $childPrice = 80; // Example base price per child passenger
                $adultCost = count($adultPassengers) * $adultPrice;
                $childCost = count($childPassengers) * $childPrice;

                // Add additional costs based on trip type
                $totalPrice = $adultCost + $childCost + $baggagePrice;
                if ($attributes['trip_type'] === 'round-trip') {
                     $totalPrice *= 2; // Example multiplier for round trips
                }
                return (float) $totalPrice;
            }
        );
    }
}
