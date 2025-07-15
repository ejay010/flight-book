<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FlightBook Admin</title>
    @vite('resources/css/app.css')
</head>
<body class="flex-col bg-gray-100">
    <header class="flex items-center justify-between bg-gray-800 text-white p-4">
        <h2>
            <a href="{{ route('admin.home') }}" class="text-2xl font-bold">FlightBook Admin</a>
            {{-- This is the title of the admin panel --}}
            {{-- The link will take the user to the admin home page --}}
        </h2>
        <nav class="flex">
            <ul class="flex space-x-4">
                <li>
                    <a href="{{ route('admin.departures.index') }}">Departures & Destinations</a>
                </li>
                <li>
                    <a href="#">Reservations</a>
                </li>
                <li>
                    <a href="#">Transactions</a>
                </li>
                <li>
                    <a href="#">Customers</a>
                </li>
                <li>
                    <a href="#">Settings</a>
                </li>
                <li>
                    <a href="#">Log Out</a>
                </li>
            </ul>
        </nav>
    </header>
    <main class="flex flex-col mx-auto mt-6 p-6">
        {{ $slot }}
    </main>
    <footer>

    </footer>
</body>
</html>