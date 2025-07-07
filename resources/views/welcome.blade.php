<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Flight Book</title>
</head>
<body>
    <main class="flex flex-col mx-auto text-center mt-6 p-6">
        <div class="mb-6">
            <h1 class="text-4xl font-bold">Welcome to Flight Book</h1>
            <p>This is a simple air charter booking application</p>
        </div>
        <div class="flex flex-col items-center">
            <p>Let's get started.</p>
            <form class="flex flex-col items-center mt-4 w-full" method="POST" action="/reservation">
                @csrf
                <fieldset class="flex flex-col min-w-full">
                    <legend class="text-2xl text-left font-bold">Personal Information</legend>
                    <div class="flex flex-col my-4">
                        <label for="name" class="place-self-start text-lg">First Name:</label>
                        <input class="outline-1 rounded-sm outline-gray-300 p-2" type="text" id="first_name" name="first_name" required>
                    </div>
                    
                    <div class="flex flex-col my-4">
                        <label for="last_name" class="place-self-start text-lg">Last Name:</label>
                        <input type="text" id="last_name" name="last_name" class="outline-1 rounded-sm outline-gray-300 p-2" required>
                    </div>
                    
                    <div class="flex flex-col my-4">
                        <label for="birthday" class="place-self-start text-lg">Birth Day:</label>
                        <input type="date" id="birthday" name="birthday" class="outline-1 rounded-sm outline-gray-300 p-2" required>
                    </div>
                    
                    <div class="flex flex-col my-4">
                        <label for="email" class="place-self-start text-lg">Email:</label>
                        <input type="email" id="email" name="email" class="outline-1 rounded-sm outline-gray-300 p-2" required>
                    </div>
                    
                    <div class="flex flex-col my-4">
                        <label for="phone_number" class="place-self-start text-lg">Phone Number:</label>
                        <input type="tel" id="phone_number" name="phone_number" class="outline-1 rounded-sm outline-gray-300 p-2" required>
                    </div>
                    
                </fieldset>
                
                <fieldset class="flex flex-col items-center my-4 text-left min-w-full">
                    <legend class="font-bold text-lg">Trip Type:</legend>
                    <div class=" rounded-sm outline-gray-300 p-2">
                        <p>Is this a one way or a round trip?</p>
                        <div class="my-2">
                            <input type="radio" id="round_trip" name="trip_type" value="round_trip" checked>
                            <label for="round_trip">Round Trip</label>
                        </div>
                    
                        <div class="my-2">
                            <input type="radio" id="one_way" name="trip_type" value="one_way">
                            <label for="one_way">One Way</label>
                        </div>
                    </div>
                </fieldset>
                

                <fieldset class="flex flex-col my-4 items-center text-left min-w-full ">
                    <legend class="font-bold text-lg">Departure Information</legend>
                

                        <div class="flex flex-col my-4 min-w-full">
                            <label for="departure">Departure:</label>
                            <input type="text" id="departure" name="departure" class="outline-1 rounded-sm outline-gray-300 p-2" required>
                        </div>

                        <div class="flex flex-col my-2 min-w-full">
                            <label for="departure_date">Departure Date:</label>
                            <input type="date" id="departure_date" name="departure_date" class="outline-1 rounded-sm outline-gray-300 p-2" required>
                        </div>
                    
                </fieldset>
                
                
                <fieldset class="flex flex-col my-4 items-center text-left min-w-full">
                    <legend class="font-bold text-lg">Return Information</legend>
                    <div class="flex flex-col my-4 min-w-full">
                        <label for="return_date">Return Date:</label>
                        <input type="date" id="return_date" name="return_date" class="outline-1 rounded-sm outline-gray-300 p-2" required>
                    </div>
                </fieldset>
                
                <div class="flex flex-col my-4 min-w-full">
                    <label for="destination" class="place-self-start text-lg">Destination:</label>
                    <input type="text" id="destination" name="destination" class="outline-1 rounded-sm outline-gray-300 p-2" required>
                </div>
                
                <div class="flex flex-col my-4 min-w-full">
                    <label for="bag_count" class="place-self-start text-lg">Number of Bags:</label>
                    <input type="number" id="bag_count" name="bag_count" min="0" max="10" class="outline-1 rounded-sm outline-gray-300 p-2 " required>
                </div>
                
                <button type="submit" class="border-2 rounded-md my-2 p-2 font-bold text-2xl hover:bg-green-100 hover:border-green-500 hover:text-green-500 min-w-full">Book Flight</button>
            </form>
        </div>
    </main>
</body>
</html>