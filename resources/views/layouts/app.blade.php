<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="IDOOH is a new provider in the outdoor advertising market in Dubai, dedicated to delivering high-quality service.">
    <meta name="keywords" content="IDOOH, Contacts, CEO, Ilya Bulygin, Mariia Faldina, +971 58 173 3443">
    <title>IDOOH</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.svg') }}">
    <link rel="preload" as="font" href="{{ asset('assets/fonts/Satoshi-Light.otf') }}" type="font/otf" crossorigin>
    <link rel="preload" as="font" href="{{ asset('assets/fonts/Satoshi-Regular.otf') }}" type="font/otf" crossorigin>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css">
    <link rel="stylesheet" href="{{ asset('assets/css/idooh.css') }}">
</head>
<body>
    @include('partials.main-menu')

    <main>
        @yield('content')
    </main>

    @include('partials.badges')

    @php
        $mapConfig = $mapConfig ?? [
            'token' => config('services.mapbox.token'),
            'style' => config('services.mapbox.style'),
        ];
    @endphp

    <script>
        window.IDOOH = window.IDOOH || {};
        window.IDOOH.mapbox = @json($mapConfig);
    </script>
    <script defer src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
    @stack('body-end')
    <script defer src="{{ asset('assets/js/app.js') }}"></script>
</body>
</html>

