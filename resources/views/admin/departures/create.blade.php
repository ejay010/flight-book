<x-admin-layout>
    <div class="flex-col mx-auto max-w-full p-6 bg-white rounded-lg shadow-md">
        <h1 class="font-bold text-2xl text-center m-3">Add a new Destination</h1>
        @if($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        <p class="text-red-500">{{ $error }}</p>
                    </li>
                @endforeach
            </ul>
        @endif
        <form action="{{ route('admin.departures.store') }}" method="POST">
            @csrf
            <div class="mb-4 w-full">
                <label for="destination">Destination:</label>
                <input class="border-1 p-2 m-2 rounded-sm max-w-full" type="text" id="destination" name="destination" required>
            </div>
            <div class="mb-4 w-full mx-auto">
                <button type="submit" class="w-full border-2 border-green-700 text-green-700 p-3 rounded-md mx-auto hover:text-white hover:bg-green-700 hover:border-white">Add Destination</button>
            </div>
        </form>
    </div>
</x-admin-layout>