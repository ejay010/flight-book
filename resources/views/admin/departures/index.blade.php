<x-admin-layout>
        {{-- Hero section for admin --}}
        <div class="mb-4">
            <h1 class="text-2xl">Departures and Destinations</h1>
            <p class="text-sm">Manage your flight departures and destinations efficiently.</p>
        </div>
            
        <a href="{{ route('admin.departures.create') }}" class="m-2 text-blue-500 underline">Add a new Destination</a>

        {{-- List of departures --}}
        <section>
            <div class="flex flex-col shadow-md rounded-lg p-4 bg-white">
                <h2 class="text-lg">Current Destinations</h2>
                <hr class="h-px my-2 bg-gray-200 border-0"/>
                <p clas="mb-9">Click to edit</p>

                <ul>
                    @foreach($destinations as $destination)
                        <li class="mb-2">
                            {{-- Link to edit the destinations --}}
                            <a href="{{ route("admin.departures.edit", ['id' => $destination->id]) }}" class="text-blue-800 hover:underline">{{ $destination->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
</x-admin-layout>