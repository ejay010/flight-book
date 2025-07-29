<x-admin-layout>
        <div class="flex flex-col items-center">
            @if ($errors->any())
                <div class="text-red-500 font-bold">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="flex flex-col mt-4 md:min-w-1/2" method="POST" action="/reservation">
                @csrf

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
                                <option v-for=" destination  in routeList" :value="destination.name" :key="destination.id">
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
                                <option v-for=" destination  in routeList" :value="destination.name" :key="destination.id">
                                    @{{ destination.name }}
                                </option>
                            </select>
                        </div>

                        <div class="flex flex-col my-4 text-left" v-show="tripInfo.tripType === 'round-trip'">
                        <label for="return_date">Return Date:</label>
                        <input type="date" id="return_date" name="return_date" class="outline-1 rounded-sm outline-gray-300 p-2" :required="tripInfo.tripType === 'round-trip'" v-model="tripInfo.returnDate" >
                    </div>
                </fieldset>

                <fieldset class="flex flex-col my-4" v-show="passengerInfoVisible" id="passenger_info">
                    <legend class="text-2xl text-left font-bold">Primary Contact Information</legend>                    
                    <div class="flex flex-col my-4">
                        <label for="first_name" class="place-self-start text-lg">First Name:</label>
                        <input type="text" id="first_name" name="primary_contact[first_name]" class="outline-1 rounded-sm outline-gray-300 p-2" required>
                    </div>
                    
                    <div class="flex flex-col my-4">
                        <label for="last_name" class="place-self-start text-lg">Last Name:</label>
                        <input type="text" id="last_name" name="primary_contact[last_name]" class="outline-1 rounded-sm outline-gray-300 p-2" required>
                    </div>
                    
                    <div class="flex flex-col my-4">
                        <label for="email" class="place-self-start text-lg">Email:</label>
                        <input type="email" id="email" name="primary_contact[email]" class="outline-1 rounded-sm outline-gray-300 p-2" required>
                    </div>
                    
                    <div class="flex flex-col my-4">
                        <label for="phone_number" class="place-self-start text-lg">Phone Number:</label>
                        <input type="tel" id="phone_number" name="primary_contact[phone_number]" class="outline-1 rounded-sm outline-gray-300 p-2" required>
                    </div>
                    
                </fieldset>
                <fieldset>
                    <legend class="text-2xl text-left font-bold">Passenger Information</legend>
                    <p class="text-left">Adult seats are $160 and childern (persons under 3 years old) are $80. The limit is 9 persons per booking.</p>
                    <p class="text-left">Please provide details for each passenger.</p>
                    <p class="text-left">If you are booking for a child under 3 years old, please select the "Child" option for that passenger.</p>
                    <div class="flex flex-col my-4">
                        <label for="passenger_count" class="place-self-start text-lg">Number of Passengers:</label>
                        <input type="number" id="passenger_count" name="passenger_count" min="1" max="9" class="outline-1 rounded-sm outline-gray-300 p-2" v-model="passengerCount" required>
                    </div>
                    <div class="flex-col md:grid grid-cols-2">
                        
                        <div v-for='n in passengerCount' :key='n' class="border-2 border-gray-300 rounded-md p-4 my-2">
                            <h3>Passenger #@{{ n }} - Details</h3>
                            <div class="flex flex-col my-4">
                                <label :for="'passengers[' + n + ']' + '[first_name]'"  class="place-self-start text-lg">First Name:</label>
                                <input class="outline-1 rounded-sm outline-gray-300 p-2" type="text" :id="'passengers[' + n + ']' + '[first_name]'" :name="'passengers[' + n + ']' + '[first_name]'" required>
                            </div>
                    
                            <div class="flex flex-col my-4">
                                <label :for="'passengers[' + n + ']' + '[last_name]'" class="place-self-start text-lg">Last Name:</label>
                                <input type="text" :id="'passengers[' + n + ']' + '[last_name]'" :name="'passengers[' + n + ']' + '[last_name]'" class="outline-1 rounded-sm outline-gray-300 p-2" required>
                            </div>
                    
                            <div class="flex flex-col my-4">
                                <label :for="'passengers[' + n + ']' + '[birthday]'" class="place-self-start text-lg">Birth Day:</label>
                                <input type="date" :id="'passengers[' + n + ']' + '[birthday]'" :name="'passengers[' + n + ']' + '[birthday]'" class="outline-1 rounded-sm outline-gray-300 p-2" required>
                            </div>

                            <div class="flex flex-col my-4">
                                <label :for="'passengers[' + n + ']' + '[is_child]'" class="place-self-start text-lg">Is Child (under 3 years old):</label>
                                <select :id="'passengers[' + n + ']' + '[is_child]'" :name="'passengers[' + n + ']' + '[is_child]'" class="outline-1 rounded-sm outline-gray-300 p-2" required>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            
                            <div class="flex flex-col my-4 min-w-full" v-show="bagInfoVisible" id="bag_info">
                                <label :for="'passengers[' + n + ']' + '[bag_count]'" class="place-self-start text-lg">Number of Bags:</label>
                                <input type="number" :id="'passengers[' + n + ']' + '[bag_count]'" :name="'passengers[' + n + ']' + '[bag_count]'" min="0" max="10" class="outline-1 rounded-sm outline-gray-300 p-2 " required>
                            </div>
                            <p class="text-left">Each passenger is allowed 1 free checked bag. Additional bags are $35 each. All backpacks are $15. Inter Island Charters reserves the right to charge for addiontal baggage at check-in.</p>
                        </div>
                    </div>
                </fieldset>
                <button type="submit" class="border-2 rounded-md my-2 p-2 font-bold text-2xl hover:bg-green-100 hover:border-green-500 hover:text-green-500 min-w-full" id="submit_button">Book Flight</button>
            </form>
        </div>
    <x-slot:scripts>
        <script>
            const { createApp } = Vue
            createApp({
                data() {
                    return {
                        tripInfo: {
                            tripType: 'one-way',
                            departure: '',
                            departureDate: '',
                            destination: '',
                            returnDate: ''
                        },
                        passengerCount: 1,
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

                    nextStep() {
                        if (this.tripType === 'round-trip') {
                            this.passengerInfoVisible = true;
                            this.bagInfoVisible = true;
                        } else {
                            this.passengerInfoVisible = true;
                            this.bagInfoVisible = false;
                        }
                    },
                    backStep() {
                        this.passengerInfoVisible = false;
                        this.bagInfoVisible = false;
                    }
                }
            }).mount('#app');
        </script>
    </x-slot>
</x-admin-layout>
    
