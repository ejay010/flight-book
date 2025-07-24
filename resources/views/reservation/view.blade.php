<x-layout>
    <h1>Reservation Details</h1>
    Trip :{{ $reservation->trip_type }}
    Departure: {{ $reservation->departure }}
    Arrival: {{ $reservation->destination }}
    Departure Date: {{ $reservation->departure_date }}
    @if ($reservation->trip_type == 'round_trip')
        Return Date: {{ $reservation->return_date }}
    @else
        <hr>
    @endif
    <h3>Primary Contact</h3>
    Name: {{ $reservation->primary_contact->first_name }} {{ $reservation->primary_contact->last_name }}
    Phone: {{ $reservation->primary_contact->phone_number }}
    Email: {{ $reservation->primary_contact->email }}
    <hr>
    <h3>Passengers ({{ $reservation->passengers->count() }})</h3>
    <ul>
        @foreach ($reservation->passengers as $passenger)
        <li>Name: {{ $passenger['first_name'] }} {{ $passenger['last_name']}}</li>
        <li>Date of Birth: {{ $passenger['birthday'] }}</li>
        {{-- <li>ID: {{ $passenger['document'] }} {{ $passenger['document_number'] }}</li> --}}
        @endforeach
    </ul>
    <hr>
    <h3>Baggage</h3>
    {{ $reservation->baggageCount }} items $35 per item ${{ $reservation->baggageCount * 35 }} total
    <h3>Pricing & Payment</h3>
    Total Price: ${{ $reservation->totalPrice }}
</x-layout>