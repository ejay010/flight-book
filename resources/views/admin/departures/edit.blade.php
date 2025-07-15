<x-admin-layout>
    <div class="flex-col mx-auto max-w-full p-6 bg-white rounded-lg shadow-md">
        <h1 class="font-bold text-2xl text-center m-3">Update Destination</h1>
        <form action="{{ route('admin.departures.update', ['id' => $destination->id]) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-4 w-full">
                <label for="destination">Destination:</label>
                <input class="border-1 p-2 m-2 rounded-sm max-w-full" type="text" id="destination" name="destination" value="{{ $destination->name }}" required>
            </div>
            <div class="mb-4 w-full mx-auto">
                <button type="submit" class="w-full border-2 border-green-700 text-green-700 p-3 rounded-md mx-auto hover:text-white hover:bg-green-700 hover:border-white">Save changes</button>
            </div>
        </form>
        <form method="POST" action="{{ route('admin.departures.delete', ['id' => $destination->id]) }}">
            @csrf
            @method('DELETE')
            <div class="mb-4 w-full mx-auto">
                <button type="submit" class="w-full border-2 border-red-700 text-red-700 p-3 rounded-md mx-auto hover:text-white hover:bg-red-700 hover:border-white">Delete Destination</button>
            </div>
        </form>
    </div>
</x-admin-layout>