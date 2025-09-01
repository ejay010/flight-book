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
        'additional_checked_bags',
        'additional_backpack',
    ];
    
    protected function casts(): array
    {
        return [
            'passengers' => 'array',
            'primary_contact' => 'array',
        ];
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

    // protected function baggageCount(): Attribute
    // {
    //     return Attribute::make(
    //         get: function ($value, array $attributes) {
    //             // get the baggage count from passengers
    //             $attributes['additional_checked_bags'];
    //             $attributes['additional_backpack'];
    //             // Ensure baggage count is always an integer
    //             return (int) $baggageCount;
    //         }
    //     );
    // }

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
                $backpackCost = 15;
                $additionalBaggageCount = $attributes['additional_checked_bags'] ?? 0;
                $backpackCount = $attributes['additional_backpack'] ?? 0;
                
                $additionalCheckedBagPrice = $additionalBaggageCount * $baggageCost;
                $backpackPrice = $backpackCount * $backpackCost;

                $baggagePrice = $backpackPrice + $additionalCheckedBagPrice;

                $adultPrice = 160; // Example base price per adult passenger
                $childPrice = 80; // Example base price per child passenger
                $adultCost = count($adultPassengers) * $adultPrice;
                $childCost = count($childPassengers) * $childPrice;

                
                $totalPrice = $adultCost + $childCost + $baggagePrice;

                // Add additional costs based on trip type
                if ($attributes['trip_type'] === 'round-trip') {
                     $totalPrice *= 2; // Example multiplier for round trips
                }
                return (float) $totalPrice;
            }
        );
    }
}
