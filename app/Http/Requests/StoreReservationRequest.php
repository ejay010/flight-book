<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'trip_type' => 'required|string|in:one-way,round-trip',
            'primary_contact.first_name' => 'required|string|max:255',
            'primary_contact.last_name' => 'required|string|max:255',
            'primary_contact.email' => 'required|email|max:255',
            'primary_contact.phone_number' => 'required|string|max:20',
            'departure' => 'required|string|max:255',
            'departure_date' => 'required|date|after_or_equal:today',
            'return_date' => 'nullable|date|after_or_equal:departure_date',
            'destination' => 'required|string|max:255',
            'passenger_count' => 'required|integer|min:1|max:9',
            'passengers.*.first_name' => 'required|string|max:255',
            'passengers.*.last_name' => 'required|string|max:255',
            'passengers.*.is_child' => 'required|boolean',
            'passengers.*.birthday' => 'required|date',
            'passengers.*.bag_count' => 'required|integer|min:0|max:5',
        ];
    }
}
