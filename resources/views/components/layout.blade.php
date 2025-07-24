<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <title>Flight Book</title>
</head>
<body>
    <main class="flex flex-col mx-auto text-center mt-6 p-6" id="app">
        {{ $slot }}
    </main>
    {{ $scripts ?? '' }}
</body>
</html>