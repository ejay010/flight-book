<x-admin-layout>
    <div class="flex flex-col bg-white p-6">
        {{-- Title --}}
        <div class="pb-3">
            <h1 class="text-lg font-bold">Reservation {{ $reservation->reference_number }}</h1>
            <h3 class="text-sm">Add Passenger</h3>
            <hr>
        </div>


        {{-- Body --}}
        <div>
            <p>Enter passenger details below</p>
            <form method="POST"
                action="{{ route('admin.reservations.passengers.store', $reservation->id) }}">
                @csrf
                <x-form-field>
                    <x-form-label for="first_name">First Name</x-form-label>
                    <x-form-input id="first_name" name="first_name"></x-form-input>
                    <x-form-error name="first_name"></x-form-error>
                </x-form-field>

                <x-form-field>
                    <x-form-label for="last_name">Last Name</x-form-label>
                    <x-form-input id="last_name" name="last_name"></x-form-input>
                    <x-form-error name="last_name"></x-form-error>
                </x-form-field>

                <x-form-field>
                    <x-form-label for="birthday">Birthday</x-form-label>
                    <x-form-input type="date" id="birthday" name="birthday"></x-form-input>
                    <x-form-error name="birthday"></x-form-error>
                </x-form-field>

                <x-form-field>
                    <x-form-error name="is_child"></x-form-error>
                    <x-form-label for="is_child">Is Child?</x-form-label>
                    <select id="is_child" name="is_child"
                        class="outline-1 rounded-sm outline-gray-300 p-2" required>
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </x-form-field>

                <div class="flex justify-end">
                    <button type="submit" class="border hover:outline-2 outline-offset-1 outline-blue-600 p-2 rounded">Save Passenger</button>
                </div>

            </form>
        </div>

    </div>

</x-admin-layout>
