<x-admin-layout>
    <div class="flex-col mx-10 max-w-full p-6 bg-white rounded-lg shadow-md">
        <h1>Edit Reservation #{{ $reservation->reference_number }} </h1>
        <hr>

        <form method="POST" action="{{ route('admin.reservations.update', $reservation->id) }}">
            @method('PATCH')
            @csrf
            <fieldset class="flex flex-col my-4" id="trip_info" v-show="tripInfoVisible">
                <legend class="font-bold text-2xl">Trip Information</legend>
                <div class="flex space-x-2 rounded-sm outline-gray-300 p-2 text-left">
                    <p>Trip Type: </p>
                    <div class="text-left">
                        <input type="radio" id="round_trip" name="trip_type" value="round-trip"
                            {{ $reservation->trip_type == 'round-trip' ? 'checked' : '' }}>
                        <label for="round_trip">Round Trip</label>
                    </div>

                    <div class="">
                        <input type="radio" id="one_way" name="trip_type" value="one-way"
                            {{ $reservation->trip_type == 'one-way' ? 'checked' : '' }}>
                        <label for="one_way">One Way</label>
                    </div>
                </div>
                <div class="flex flex-col my-2 text-left">
                    <label for="departure">Departure:</label>
                    <select name="departure" id="departure" class="outline-1 rounded-sm outline-gray-300 p-2" required>
                        @foreach($destinations as $destination)
                            <option value="{{ $destination->name }}"
                                {{ $reservation->departure == $destination->name ? 'selected' : '' }}>
                                {{ $destination->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col my-2 text-left">
                    <label for="departure_date">Departure Date:</label>
                    <input type="date" id="departure_date" name="departure_date"
                        class="outline-1 rounded-sm outline-gray-300 p-2" min="{{ now() }}"
                        value="{{ $reservation->departure_date }}" required>
                </div>
                <div class="flex flex-col my-2 text-left">
                    <label for="destination">Destination:</label>
                    <select name="destination" id="destination" class="outline-1 rounded-sm outline-gray-300 p-2"
                        required>
                        @foreach($destinations as $destination)
                            <option value="{{ $destination->name }}"
                                {{ $reservation->destination == $destination->name ? 'selected' : '' }}>
                                {{ $destination->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @if ($reservation->return_date != null)
                <div class="flex flex-col my-4 text-left">
                    <label for="return_date">Return Date:</label>
                    <input type="date" id="return_date" name="return_date"
                        class="outline-1 rounded-sm outline-gray-300 p-2"
                        min="{{ $reservation->departure_date }}">
                </div>
                @endif

            </fieldset>

            <fieldset class="flex flex-col my-4" v-show="passengerInfoVisible" id="passenger_info">
                <legend class="text-2xl text-left font-bold">Contact Information</legend>

                <x-form-field>
                    <x-form-label for="first_name">Primary Contact First Name:</x-form-label>
                    <x-form-input id="first_name" name="primary_contact[first_name]" @:v-model="primaryContact"
                        value="{{ $reservation->primary_contact->first_name }}" required></x-form-input>
                    <x-form-error name="first_name" />
                </x-form-field>

                <x-form-field>
                    <x-form-label for="last_name">Primary Contact Last Name:</x-form-label>
                    <x-form-input id="last_name" name="primary_contact[last_name]" @:v-model="primaryContact"
                        value="{{ $reservation->primary_contact->last_name }}" required></x-form-input>
                    <x-form-error name="primary_contact[last_name]" />
                </x-form-field>

                <x-form-field>
                    <x-form-label for="email">Primary Contact Email:</x-form-label>
                    <x-form-input id="email" name="primary_contact[email]" @:v-model="primaryContact"
                        value="{{ $reservation->primary_contact->email }}" required></x-form-input>
                    <x-form-error name="primary_contact[email]" />
                </x-form-field>

                <x-form-field>
                    <x-form-label for="phone_number">Primary Contact Phone Number:</x-form-label>
                    <x-form-input id="phone_number" name="primary_contact[phone_number]" @:v-model="primaryContact"
                        value="{{ $reservation->primary_contact->phone_number }}" required></x-form-input>
                    <x-form-error name="primary_contact[phone_number]" />
                </x-form-field>

            </fieldset>
            <fieldset>
                <legend class="text-2xl text-left font-bold">Passenger Details</legend>
                <p class="text-left">Adult seats are $160 and childern (persons under 3 years old) are $80. The limit is
                    9 persons per booking.</p>
                <p class="text-left">Please provide details for each passenger.</p>
                <p class="text-left">If you are booking for a child under 3 years old, please select the "Child" option
                    for that passenger.</p>
                <p>Number of Passengers: {{ $reservation->passenger_count }}

                    <a href="{{ route('admin.reservations.passengers.create', $reservation->id) }}" type="button"  class="border p-1 rounded shadow-md hover:border-blue-500 hover:text-blue-500 hover:outline">Add Passenger</a>
                    <div class="flex-col md:grid grid-cols-2">
                        @foreach($reservation->passengers->toArray() as $key => $passenger)
                            <div class="border-2 border-gray-300 rounded-md p-4 m-2">
                                <h3>Passenger #{{ $loop->index + 1 }} - Details</h3>
                                <div class="flex flex-col my-4">
                                    <label for="passengers[{{ $key }}][first_name]" class="place-self-start text-lg">First
                                        Name:</label>
                                    <input class="outline-1 rounded-sm outline-gray-300 p-2" type="text"
                                        id="passengers[{{ $key }}][first_name]" name="passengers[{{ $key }}][first_name]"
                                        value="{{ $passenger["first_name"] }}" required>
                                </div>

                                <div class="flex flex-col my-4">
                                    <label for="passengers[{{ $key }}][last_name]" class="place-self-start text-lg">Last
                                        Name:</label>
                                    <input type="text" id="passengers[{{ $key }}][last_name]" name="passengers[{{ $key }}][last_name]"
                                        value="{{ $passenger["last_name"] }}"
                                        class="outline-1 rounded-sm outline-gray-300 p-2" required>
                                </div>

                                <div class="flex flex-col my-4">
                                    <label for="passengers[{{ $key }}][birthday]" class="place-self-start text-lg">Birth
                                        Day:</label>
                                    <input type="date" id="passengers[{{ $key }}][birthday]" name="passengers[{{ $key }}][birthday]"
                                        value="{{ $passenger["birthday"] }}"
                                        class="outline-1 rounded-sm outline-gray-300 p-2" required>
                                </div>

                                <div class="flex flex-col my-4">
                                    <label for="passengers[{{ $key }}][is_child]" class="place-self-start text-lg">Is Child
                                        (under 3 years old):</label>
                                    <select id="passengers[{{ $key }}][is_child]" name="passengers[{{ $key }}][is_child]"
                                        value="{{ $passenger["is_child"] }}"
                                        class="outline-1 rounded-sm outline-gray-300 p-2" required>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="flex flex-col md:flex-row">

                                <x-button type="link" href="{{ route('admin.reservation.passenger.edit', ['id' => $reservation->id, 'index' => $key]) }}">Edit Passenger</x-button>
                                <x-button type="link" href="{{ route('admin.reservation.passenger.remove', ['id' => $reservation->id, 'index' => $key]) }}">Remove Passenger</x-button>
                                </div>
                            </div>

                        @endforeach

                    </div>

            </fieldset>
            <fieldset class="flex flex-col my-4" v-show="bagInfoVisible" id="bag_info">
                <legend class="text-2xl text-left font-bold">Baggage Information</legend>
                <p class="text-left">Each passenger is allowed 1 free checked bag. Additional bags are $35 each. All
                    backpacks are $15. Inter Island Charters reserves the right to charge for addiontal baggage at
                    check-in. Oversized or overweight (50lbs or more) bags are $25.</p>
                <div class="flex space-x-3">
                    <div class="flex flex-col my-4 w-1/2">
                        <label for="additional_checked_bags" class="place-self-start text-lg">Checked Bags:
                            {{ $reservation->additional_checked_bags }}</label>
                            <input class="outline-1 rounded-sm outline-gray-300 p-2" type="number" id="additional_checked_bags" name="additional_checked_bags" value="{{ $reservation->additional_checked_bags }}">
                    </div>
                    <div class="flex flex-col my-4 w-1/2">
                        <label for="additional_backpacks" class="place-self-start text-lg">Backpacks:
                            {{ $reservation->additional_backpack }}</label>
                            <input class="outline-1 rounded-sm outline-gray-300 p-2" type="number" id="additional_backpacks" name="additional_backpacks" value="{{ $reservation->additional_backpack }}">
                    </div>
                </div>

            </fieldset>
            <fieldset>
                <x-form-field>
                    <x-form-label for="payment_status">Payment Status</x-form-label>
                    <select id="payment_status" name="payment_status" class="outline-1 rounded-sm outline-gray-300 p-2">
                        <option value="Paid" {{ $reservation->payment_status == 'Paid' ? 'selected' : '' }}>Paid</option>
                        <option value="Not_Paid" {{ $reservation->payment_status == 'Not_Paid' ? 'selected' : '' }}>Not Paid</option>
                        <option value="Processing" {{ $reservation->payment_status == 'Processing' ? 'selected' : '' }}>Processing</option>
                    </select>
                </x-form-field>
            </fieldset>

            <fieldset>
                <x-form-field>
                    <x-form-label for="confirmation">Flight Confirmation Status</x-form-label>
                    <select id="confirmation" name="confirmation" class="outline-1 rounded-sm outline-gray-300 p-2">
                        <option value="Confirmed" {{ $reservation->payment_status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="Pending Review" {{ $reservation->payment_status == 'Pending_Review' ? 'selected' : '' }}>Pending Review</option>
                        <option value="Processing" {{ $reservation->payment_status == 'Processing' ? 'selected' : '' }}>Processing</option>
                        <option value="Cancelled" {{ $reservation->payment_status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </x-form-field>
            </fieldset>



            <x-button type="submit">Save Changes</x-button>
        </form>
    </div>
</x-admin-layout>
