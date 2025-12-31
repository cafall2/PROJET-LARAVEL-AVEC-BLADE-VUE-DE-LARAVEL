<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles par défaut -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        @yield('content') <!-- Ici les pages Blade vont s'injecter -->
    </div>

    <!-- Scripts par défaut -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
