<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bebas') }}</title>


    <!-- Styles -->
    <link rel="stylesheet" href={{ asset('assets/css/style.css') }}>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <!-- Auto Refresh Local -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

{{ $slot }}

</html>
