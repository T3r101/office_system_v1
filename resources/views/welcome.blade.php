<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Office System</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="text-center bg-white p-10 rounded-xl shadow-lg">
        <h1 class="text-3xl font-bold text-gray-800">Office System</h1>
        <p class="text-gray-500 mt-1 mb-8">City of Malaybalay</p>
        
<div class="space-y-4">
            <a href="{{ url('/login') }}" 
               class="block w-full px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition text-center">
                Login to Office System
            </a>
            <p class="text-gray-500 text-sm">Contact administrator for account access</p>
        </div>
    </div>

</body>
</html>