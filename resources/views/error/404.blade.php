<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page Not Found - 404</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap');

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Nunito', sans-serif;
            }

            *::selection {
                color: #fff;
                background: #dc2626;
            }
        </style>
    </head>
    <body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">
        <div class="text-center">
            <h1 class="text-9xl font-bold text-red-600">404</h1>
            <p class="mt-4 text-2xl font-semibold">Page Not Found</p>
            <p class="mt-2 text-gray-400">Sorry, the page you are looking for doesn't exist or has been removed.</p>
            <a href="{{ route('home') }}" class="mt-6 inline-block bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition duration-300">
                Return to Home
            </a>
        </div>
    </body>
</html>
