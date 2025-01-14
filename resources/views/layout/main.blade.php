<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ env('APP_NAME') }} - @yield('page_title')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/notification.css') }}">
    </head>
    <body>
        @include('partial.sidebar')
        @yield('main')
    </body>
    @yield('scripts')
    <script src="{{ asset('js/notification.js') }}"></script>
</html>
