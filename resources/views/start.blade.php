<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Style -->
        <style>
            body {
                font-family: 'Comic Sans MS', cursive, sans-serif;
                background-color: #EECEB9;
                margin: 0;
                padding: 0;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <h1>Mentari</h1>
        <h2>E - Learning Elementary</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="text" name="name">
            <button type="submit">START</button>
        </form>
    </body>
</html>
