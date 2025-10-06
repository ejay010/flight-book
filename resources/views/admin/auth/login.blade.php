<x-admin-layout>
    <h1 class="text-3xl font-bold mb-6">Admin Login</h1>
    <hr>
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ $errors->first() }}</span>
        </div>
    @endif
    <form method="POST" action="{{ route('admin.login.submit') }}" class="mt-6">
        @csrf
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email:</label>
            <input type="email" id="email" name="email" required class="w-full p-2 border border-gray-300 rounded mt-1">
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700">Password:</label>
            <input type="password" id="password" name="password" required class="w-full p-2 border border-gray-300 rounded mt-1">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Login</button>
    </form>
</x-admin-layout>
