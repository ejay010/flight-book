<x-admin-layout>
<h1 class="text-3xl font-bold mb-6">Settings</h1>
<hr>

<p class="mt-4">Manage application settings and configurations.</p>

<h3>User Management</h3>

<p class="mb-4">Add, remove, or modify admin users and their permissions.</p>
<a href="{{ route('admin.users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add New Admin User</a>

</x-admin-layout>
