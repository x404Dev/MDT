<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1">
    <meta name="csrf-token"
        content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{asset("assets/bootstrap/css/bootstrap.min.css")}}">
    <link rel="icon" type="image/x-icon" href="favicon.ico">

    <!-- Fonts -->
    <link rel="stylesheet"
        href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .bg-gray {
            background-color: #006aff;
        }

        input[type='text'] {
            font-family: BellSlimMedium, sans-serif;
        }
        .blue-btn {
            border-radius: 50px;
            border: 2px #006aff solid;
            color: #006aff;
            transition: 0.3s;
            padding: 2px 15px;
            background-color: transparent;
            margin: 2px;
        }

        .blue-btn:hover {
            background-color: #006aff;
            color: #fff;
        }
        .white-btn {
            border-radius: 50px;
            border: 2px #fff solid;
            color: #fff;
            transition: 0.3s;
            padding: 2px 15px;
            background-color: transparent;
            margin: 2px;
        }

        .white-btn:hover {
            background-color: #fff;
            color: #006aff;
        }
        .mdt-input {
            border-radius: 50px;
            padding: 5px 15px;
            border: 2px #262626 solid;
            width: 100%;
            margin: 5px 0;
        }
        a.gray-link {
            color: #d3d3d3;
            transition: 0.3s;
        }
        a.gray-link:hover {
            color: #ffffff;
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray">
        <div>
            <a href="/">
                <img src="{{ asset('/assets/img/logo.png') }}"
                    class="w-20 h-20">
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 overflow-hidden">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
