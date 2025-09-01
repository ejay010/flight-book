<!DOCTYPE html>
<html lang="en" class="antialiased smooth-scroll">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <title>Inter Island Charters | Flight Book</title>
    {{-- primary: #19232d ocean blue: #0ea8c1 forest green: #7eb51f --}}
</head>
<body class="text-white">
    <header class="md:flex justify-between text-black mx-auto px-2">
        <div>
            <img src="{{ Vite::asset('resources/images/interIslandChartersLogo.png') }}" alt="Inter Island Charters Logo" class="mx-auto mt-4 mb-2 h-24" >
        </div>
        <nav class="flex px-4">
            <ul class="space-y-2 text-center mx-auto md:hidden">
                <li>Home</li>
                <li>Contact Us</li>
            </ul>

            <ul class="hidden md:flex items-center space-x-6">
                <li>Home</li>
                <li>Contact Us</li>
            </ul>
        </nav>
    </header>
    <main class="flex flex-col mx-auto text-center px-6 md:px-24 py-12 bg-[#19232d]" id="app">
        {{ $slot }}
    </main>
    {{ $scripts ?? '' }}
</body>
</html>