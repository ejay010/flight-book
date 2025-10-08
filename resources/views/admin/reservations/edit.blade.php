<x-admin-layout>
    <div class="flex-col mx-10 max-w-full p-6 bg-white rounded-lg shadow-md">
        <h1>Edit Reservation #{{ $reservation->reference_number }} </h1>
        <hr>

        <form method="POST" action="#">
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
                        @foreach($reservation->passengers->toArray() as  $passenger)
                            <div class="border-2 border-gray-300 rounded-md p-4 m-2">
                                <h3>Passenger #{{ $loop->index + 1 }} - Details</h3>
                                <div class="flex flex-col my-4">
                                    <label for="{{$passenger['first_name']}}" class="place-self-start text-lg">First
                                        Name:</label>
                                    <input class="outline-1 rounded-sm outline-gray-300 p-2" type="text"
                                        id="{{$passenger['first_name']}}" name="{{$passenger['first_name']}}"
                                        value="{{ $passenger['first_name'] }}" required>
                                </div>

                                <div class="flex flex-col my-4">
                                    <label for="{{ $passenger['last_name'] }}" class="place-self-start text-lg">Last
                                        Name:</label>
                                    <input type="text" id="{{ $passenger['last_name'] }}" name="{{ $passenger['last_name'] }}"
                                        value="{{ $passenger['last_name'] }}"
                                        class="outline-1 rounded-sm outline-gray-300 p-2" required>
                                </div>

                                <div class="flex flex-col my-4">
                                    <label for="{{ 'passenger' . $loop->index + 1 . '-birthday'  }}" class="place-self-start text-lg">Birth
                                        Day:</label>
                                    <input type="date" id="{{ 'passenger' . $loop->index + 1 . '-birthday'  }}" name="{{ 'passenger[' . $loop->index + 1 . '].birthday'  }}"
                                        value="{{ $passenger['birthday'] }}"
                                        class="outline-1 rounded-sm outline-gray-300 p-2" required>
                                </div>

                                <div class="flex flex-col my-4">
                                    <label for="passengers[{{ $loop->index + 1 }}].is_child" class="place-self-start text-lg">Is Child
                                        (under 3 years old):</label>
                                    <select id="passengers[{{ $loop->index + 1 }}].is_child" name="passengers[{{ $loop->index + 1 }}].is_child"
                                        value="{{ $passenger['is_child'] }}"
                                        class="outline-1 rounded-sm outline-gray-300 p-2" required>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>

                                <button>Save Changes</button>
                                <button>Remove Passenger</button>
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
                        <button type="button"
                            class="border-2 rounded-md my-2 p-4 font-bold text-2xl hover:bg-[#0ea8c1] hover:text-gray-800"
                            @click="addCheckedBag">Add an Extra Bag</button>
                        <button type="button" v-show="additionalBag > 0"
                            class="border-2 rounded-md my-2 p-4 font-bold text-2xl hover:bg-[#0ea8c1] hover:text-gray-800"
                            @click="removeCheckedBag">Remove a Bag</button>
                    </div>
                    <div class="flex flex-col my-4 w-1/2">
                        <label for="additional_backpacks" class="place-self-start text-lg">Backpacks:
                            {{ $reservation->additional_backpack }}</label>
                        <button type="button"
                            class="border-2 rounded-md my-2 p-4 font-bold text-2xl hover:bg-[#0ea8c1] hover:text-gray-800"
                            @click="addBackpack">Add a Backpack</button>
                        <button v-show="additionalBackpack > 0" type="button"
                            class="border-2 rounded-md my-2 p-4 font-bold text-2xl hover:bg-[#0ea8c1] hover:text-gray-800"
                            @click="removeBackpack">Remove a Backpack</button>
                    </div>
                </div>

            </fieldset>
            <button type="submit">Save Changes</button>
        </form>
        <x-slot:scripts>

            <script>
                // Vue.createApp({
                //     data() {
                //         return {
                //             tripInfo: {
                //                 tripType: {{ Js::from($reservation->trip_type) }},
                //                 departure: {{ Js::from($reservation->departure) }},
                //                 departureDate: {{ Js::from($reservation->departure_date) }},
                //                 destination: {{ Js::from($reservation->destination) }},
                //                 returnDate: {{ Js::from($reservation->return_date) }}
                //             },
                //             passengerCount: {{ Js::from($reservation->passenger_count) }},
                //             passengers: {{ Js::from($reservation->passengers) }},
                //             primaryContact: {{ Js::from($reservation->primary_contact) }},
                //             additionalBag: 0,
                //             additionalBackpack: 0,
                //             tripInfoVisible: true,
                //             passengerInfoVisible: true,
                //             bagInfoVisible: true,
                //             routeList: {{ Js::from($destinations->toArray()) }}
                //         };
                //     },
                //     computed: {
                //         today() {
                //             let currentdate = new Date();
                //             let day = currentdate.getDate();
                //             let month = currentdate.getMonth();
                //             let year = currentdate.getFullYear();
                //             if (day < 10) {
                //                 day = '0' + day
                //             }
                //             if (month < 10){
                //                 month = '0' + month
                //             }
                //             let dateString = year +'-'+ month +'-'+ day;
                //             return dateString
                //         }
                //     },
                //     methods: {
                //         checkTripInfo() {
                //             if (tripInfo.departure != '' || null) {
                //                 if (tripInfo.departureDate != '' || null) {

                //                 }
                //             }
                //         },
                //         addCheckedBag() {
                //             this.additionalBag += 1
                //         },
                //         addBackpack() {
                //             this.additionalBackpack += 1
                //         },
                //         removeCheckedBag() {
                //             this.additionalBag -= 1
                //         },
                //         removeBackpack() {
                //             this.additionalBackpack -= 1
                //         },
                //     },
                // }).mount('#app');

            </script>
            </x-slot>
    </div>
</x-admin-layout>
