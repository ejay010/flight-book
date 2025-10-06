<x-admin-layout>
    <x-button type="link" href="{{ route('admin.reservations.index') }}">
        Back to Reservations List
    </x-button>
    <h1 class="text-xl m-2 font-bold">Reservation Details</h1>
    <h2 class="text-lg font-bold">Code: {{ $reservation->reference_number }}</h2>
    <h2 class="text-lg font-bold">Confirmation: {{ $reservation->confirmation }}</h2>
    <div class="md:grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="text-left m-4">
            <h1 class="text-xl font-bold m-2">Flight Details</h1>
        <span class="font-bold">Trip Type: {{ $reservation->trip_type }}</span>
        <br><span>From: <span class="font-bold">{{ $reservation->departure }}</span></span>
        <br><span>To: <span class="font-bold">{{ $reservation->destination }}</span></span>
        <br><span>Departure Date: <span class="font-bold">{{ $reservation->departure_date }}</span></span>
        @if ($reservation->trip_type == 'round_trip')
            <li>Return Date: {{ $reservation->return_date }}</li>
        @endif
        </div>

        <div class="m-4 text-left">
            <h3 class="text-lg m-2 font-bold">Primary Contact</h3>
        <p>
        Name: {{ $reservation->primary_contact->first_name }} {{ $reservation->primary_contact->last_name }}
        <br>Phone: {{ $reservation->primary_contact->phone_number }}
        <br>Email: {{ $reservation->primary_contact->email }}
        </p>
        </div>

        <div class="m-4 text-left">
        <h3 class="text-lg m-2 font-bold">Passengers ({{ $reservation->passengers->count() }} Seat(s))</h3>
        <div class="m-2 border rounded p-2 text-left">
            @foreach ($reservation->passengers as $passenger)
            <span>Name: {{ $passenger['first_name'] }} {{ $passenger['last_name']}}</span>
            <br><span>Date of Birth: {{ $passenger['birthday'] }}</span>
            <br><span>Extra Checked Bags: {{ $reservation->additional_checked_bags }}</span>
            <br><span>Backpacks: {{ $reservation->additional_backpack }}</span>
            <br>
            {{-- <li>ID: {{ $passenger['document'] }} {{ $passenger['document_number'] }}</li> --}}
            @endforeach
        </div>
        </div>

        <div class="m-4 text-left">
            <h3 class="text-lg font-bold">Pricing & Payment</h3>
            <span></span>
            <span>Total Price: ${{ $reservation->totalPrice }}</span>
        </div>


    </div>
    <div class="flex flex-col space-y-2 m-2">
        <a href="{{ route('admin.reservation.confirmAndInvoice') }}" class="mx-4 my-2 border border-2 rounded-sm p-4 text-lg font-bold md:tracking-2 lg:tracking-wide hover:bg-[#7eb51f] hover:text-white">Confrim & Invoice Reservation</a>
        <a href="#" class="mx-4 my-2 border border-2 rounded-sm p-4 text-lg font-bold md:tracking-2 lg:tracking-wide">Cancel Reservation</a>
    </div>

</x-admin-layout>
