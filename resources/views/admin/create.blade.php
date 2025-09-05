<x-admin-layout>
    <h1 class="text-3xl font-bold mb-6">Create Administrator</h1>

    <form method="POST" action="{{ route('admin.users.store') }}" class="max-w-lg bg-white p-6 rounded shadow">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
            <input type="text" id="name" name="name" class="w-full border border-gray-300 p-2 rounded" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
            <input type="email" id="email" name="email" class="w-full border border-gray-300 p-2 rounded" required>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
            <input type="password" id="password" name="password" class="w-full border border-gray-300 p-2 rounded" required>
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="w-full border border-gray-300 p-2 rounded" required>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create Admin</button>
        </div>
    </form>
</x-admin-layout>
