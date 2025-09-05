<x-admin-layout>
    <h1 class="text-3xl font-bold mb-6">Reservations</h1>

    <div class="mb-4">
        <a href="{{ route('admin.reservations.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create New Reservation</a>
    </div>

    @if($reservations->isEmpty())
        <p>No reservations found.</p>
    @else
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Reference Number</th>
                    <th class="border px-4 py-2">Customer Name</th>
                    <th class="border px-4 py-2">Departure Date</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td class="border px-4 py-2">
                            <a href="{{ route('admin.reservations.view', $reservation->id) }}" class="text-blue-500 hover:underline">
                            {{ $reservation->reference_number }}
                            </a>
                        </td>
                        <td class="border px-4 py-2">{{ $reservation->primary_contact->first_name }} {{ $reservation->primary_contact->last_name}}</td>
                        <td class="border px-4 py-2">{{ $reservation->departure_date }}</td>
                        <td class="border px-4 py-2">
                            <!-- Add action buttons here -->
                            <a href="{{ route('admin.reservations.edit', $reservation->id) }}" class="text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-admin-layout>
