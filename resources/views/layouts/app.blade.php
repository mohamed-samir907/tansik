<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tansik') }}</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- Bulma Version 0.7.4-->
    {{-- <link rel="stylesheet" href="https://unpkg.com/bulma@0.7.4/css/bulma.min.css" /> --}}
    <link rel="stylesheet" href="{{ url('css/bulma-rtl.min.css') }}">
    <style>
        @font-face {
            font-family: "Tajawal";
            src: url("{{ url('fonts/Tajawal-Regular.ttf') }}");
        }

        * {
            font-family: 'Tajawal', 'sans-serif' !important;
        }
        html,body {
            font-family: 'Tajawal', 'sans-serif' !important;
            font-size: 16px;
            background: #F0F2F4;
        }
    </style>
    @yield('style')
</head>
<body>
    
    @yield('content')

    @yield('script')
</body>
</html>
