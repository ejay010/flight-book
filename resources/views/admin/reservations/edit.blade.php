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
                            <input type="radio" id="round_trip" name="trip_type" value="round-trip" v-model="tripInfo.tripType" checked>
                            <label for="round_trip">Round Trip</label>
                        </div>

                        <div class="">
                            <input type="radio" id="one_way" name="trip_type" value="one-way" v-model="tripInfo.tripType">
                            <label for="one_way">One Way</label>
                        </div>
                    </div>
                    <div class="flex flex-col my-2 text-left">
                            <label for="departure">Departure:</label>
                            <select name="departure" id="departure" class="outline-1 rounded-sm outline-gray-300 p-2" v-model="tripInfo.departure" required>
                                <option v-for=" destination  in routeList" :value="destination.name" :key="destination.id" class="text-black">
                                    @{{ destination.name }}
                                </option>
                            </select>
                        </div>

                        <div class="flex flex-col my-2 text-left">
                            <label for="departure_date">Departure Date:</label>
                            <input v-model="tripInfo.departureDate" type="date" id="departure_date" name="departure_date" class="outline-1 rounded-sm outline-gray-300 p-2" :min="today" required>
                        </div>

                        <div class="flex flex-col my-2 text-left">
                            <label for="destination">Destination:</label>
                            <select name="destination" id="destination" class="outline-1 rounded-sm outline-gray-300 p-2" v-model="tripInfo.destination" required>
                                <option v-for=" destination  in routeList" :value="destination.name" :key="destination.id" class="text-black">
                                    @{{ destination.name }}
                                </option>
                            </select>
                        </div>

                        <div class="flex flex-col my-4 text-left" v-show="tripInfo.tripType === 'round-trip'">
                        <label for="return_date">Return Date:</label>
                        <input type="date" id="return_date" name="return_date" class="outline-1 rounded-sm outline-gray-300 p-2" :required="tripInfo.tripType === 'round-trip'" v-model="tripInfo.returnDate" :min="tripInfo.departureDate" v-bind:disabled="tripInfo.tripType === 'one-way'">
                    </div>
                </fieldset>

                <fieldset class="flex flex-col my-4" v-show="passengerInfoVisible" id="passenger_info">
                    <legend class="text-2xl text-left font-bold">Contact Information</legend>

                    <x-form-field>
                        <x-form-label for="first_name">Primary Contact First Name:</x-form-label>
                        <x-form-input id="first_name" name="primary_contact[first_name]" @:v-model="primaryContact" value="{{ $reservation->primary_contact->first_name }}" required></x-form-input>
                        <x-form-error name="first_name"/>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="last_name">Primary Contact Last Name:</x-form-label>
                        <x-form-input id="last_name" name="primary_contact[last_name]" @:v-model="primaryContact" value="{{ $reservation->primary_contact->last_name }}" required></x-form-input>
                        <x-form-error name="primary_contact[last_name]"/>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="email">Primary Contact Email:</x-form-label>
                        <x-form-input id="email" name="primary_contact[email]" @:v-model="primaryContact" value="{{ $reservation->primary_contact->email }}" required></x-form-input>
                        <x-form-error name="primary_contact[email]"/>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="phone_number">Primary Contact Phone Number:</x-form-label>
                        <x-form-input id="phone_number" name="primary_contact[phone_number]" @:v-model="primaryContact" value="{{ $reservation->primary_contact->phone_number }}" required></x-form-input>
                        <x-form-error name="primary_contact[phone_number]"/>
                    </x-form-field>

                </fieldset>
                <fieldset>
                    <legend class="text-2xl text-left font-bold">Passenger Details</legend>
                    <p class="text-left">Adult seats are $160 and childern (persons under 3 years old) are $80. The limit is 9 persons per booking.</p>
                    <p class="text-left">Please provide details for each passenger.</p>
                    <p class="text-left">If you are booking for a child under 3 years old, please select the "Child" option for that passenger.</p>
                    <p>Number of Passengers: {{ $reservation->passenger_count }}

                        <button>Add Passenger</button>
                    <div class="flex-col md:grid grid-cols-2">
                        <div v-for='n in passengerCount' :key='n' class="border-2 border-gray-300 rounded-md p-4 m-2">
                            <h3>Passenger #@{{ n }} - Details</h3>
                            @{{ passengers[n][first_name] }}
                            <div class="flex flex-col my-4">
                                <label :for="passengers[n].first_name"  class="place-self-start text-lg">First Name:</label>
                                <input class="outline-1 rounded-sm outline-gray-300 p-2" type="text" :id="passengers[n].first_name" :name="passengers[n].first_name" v-model="passengers[n].first_name" required>
                            </div>

                            <div class="flex flex-col my-4">
                                <label :for="passengers[n].last_name" class="place-self-start text-lg">Last Name:</label>
                                <input type="text" :id="passengers[n].last_name" :name="passengers[n].last_name" v-model="passengers[n].last_name" class="outline-1 rounded-sm outline-gray-300 p-2" required>
                            </div>

                            <div class="flex flex-col my-4">
                                <label :for="passengers[n].birthday" class="place-self-start text-lg">Birth Day:</label>
                                <input type="date" :id="passengers[n].birthday" :name="passengers[n].birthday" v-model="passengers[n].birthday" class="outline-1 rounded-sm outline-gray-300 p-2" required>
                            </div>

                            <div class="flex flex-col my-4">
                                <label :for="passengers[n].is_child" class="place-self-start text-lg">Is Child (under 3 years old):</label>
                                <select :id="passengers[n].is_child" :name="passengers[n].is_child" v-model="passengers[n].is_child" class="outline-1 rounded-sm outline-gray-300 p-2" required>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>

                            <button>Save Changes</button>
                            <button>Remove Passenger</button>

                            {{-- <div class="flex flex-col my-4 min-w-full" v-show="bagInfoVisible" id="bag_info">
                                <label :for="'passengers[' + n + ']' + '[bag_count]'" class="place-self-start text-lg">Number of Bags:</label>
                                <input type="number" :id="'passengers[' + n + ']' + '[bag_count]'" :name="'passengers[' + n + ']' + '[bag_count]'" min="0" max="10" class="outline-1 rounded-sm outline-gray-300 p-2 " required>
                            </div> --}}
                        </div>
                    </div>

                </fieldset>
                <fieldset class="flex flex-col my-4" v-show="bagInfoVisible" id="bag_info">
                    <legend class="text-2xl text-left font-bold">Baggage Information</legend>
                    <p class="text-left">Each passenger is allowed 1 free checked bag. Additional bags are $35 each. All backpacks are $15. Inter Island Charters reserves the right to charge for addiontal baggage at check-in. Oversized or overweight (50lbs or more) bags are $25.</p>
                    <div class="flex space-x-3">
                        <div class="flex flex-col my-4 w-1/2">
                        <label for="additional_checked_bags" class="place-self-start text-lg">Additional Checked Bags: @{{ additionalBag }}</label>
                        <input type="hidden" name="additional_checked_bags" value="0" id="additional_checked_bags" v-model="additionalBag">
                        <button type="button" class="border-2 rounded-md my-2 p-4 font-bold text-2xl hover:bg-[#0ea8c1] hover:text-gray-800" @click="addCheckedBag">Add an Extra Bag</button>
                        <button type="button" v-show="additionalBag > 0" class="border-2 rounded-md my-2 p-4 font-bold text-2xl hover:bg-[#0ea8c1] hover:text-gray-800" @click="removeCheckedBag">Remove a Bag</button>
                    </div>
                    <div class="flex flex-col my-4 w-1/2">
                        <label for="additional_backpacks" class="place-self-start text-lg">Backpacks: @{{ additionalBackpack }}</label>
                        <input type="hidden" name="additional_backpack" value="0" id="additional_backpack" v-model="additionalBackpack">
                        <button type="button" class="border-2 rounded-md my-2 p-4 font-bold text-2xl hover:bg-[#0ea8c1] hover:text-gray-800" @click="addBackpack">Add a Backpack</button>
                        <button v-show="additionalBackpack > 0" type="button" class="border-2 rounded-md my-2 p-4 font-bold text-2xl hover:bg-[#0ea8c1] hover:text-gray-800" @click="removeBackpack">Remove a Backpack</button>
                    </div>
                    </div>

                </fieldset>
        <button type="submit">Save Changes</button>
    </form>
     <x-slot:scripts>

        <script>
            Vue.createApp({
                data() {
                    return {
                        tripInfo: {
                            tripType: {{ Js::from($reservation->trip_type) }},
                            departure: {{ Js::from($reservation->departure) }},
                            departureDate: {{ Js::from($reservation->departure_date) }},
                            destination: {{ Js::from($reservation->destination) }},
                            returnDate: {{ Js::from($reservation->return_date) }}
                        },
                        passengerCount: {{ Js::from($reservation->passenger_count) }},
                        passengers: {{ Js::from($reservation->passengers) }},
                        primaryContact: {{ Js::from($reservation->primary_contact) }},
                        additionalBag: 0,
                        additionalBackpack: 0,
                        tripInfoVisible: true,
                        passengerInfoVisible: true,
                        bagInfoVisible: true,
                        routeList: {{ Js::from($destinations->toArray()) }}
                    };
                },
                computed: {
                    today() {
                        let currentdate = new Date();
                        let day = currentdate.getDate();
                        let month = currentdate.getMonth();
                        let year = currentdate.getFullYear();
                        if (day < 10) {
                            day = '0' + day
                        }
                        if (month < 10){
                            month = '0' + month
                        }
                        let dateString = year +'-'+ month +'-'+ day;
                        return dateString
                    }
                },
                methods: {
                    checkTripInfo() {
                        if (tripInfo.departure != '' || null) {
                            if (tripInfo.departureDate != '' || null) {

                            }
                        }
                    },
                    addCheckedBag() {
                        this.additionalBag += 1
                    },
                    addBackpack() {
                        this.additionalBackpack += 1
                    },
                    removeCheckedBag() {
                        this.additionalBag -= 1
                    },
                    removeBackpack() {
                        this.additionalBackpack -= 1
                    },
                },
            }).mount('#app');
        </script>
    </x-slot>
</div>
</x-admin-layout>
