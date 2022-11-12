<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {{-- HTML --}}
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="current-lang" content="{{ App::getLocale() }}">

        {{-- Page title tag --}}
        <title>Drost Machinehandel - {{ __('/content/app.'.ucfirst(Route::currentRouteName())) }}</title>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>
    
        {{-- Fontawesome --}}
        <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    
        {{-- Flowbite --}}
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
        <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
    
        {{-- Required custom scss and js --}}
        @vite(['resources/scss/dashboard.scss', 'resources/vue/dashboard.js'])
    </head>

    <body class="bg-gray-800 font-sans leading-normal tracking-normal mt-12 page-{{ Route::currentRouteName() }}">
        {{-- Navbar --}}
        @include('layouts/dashboard.navbar')

        {{-- Page content --}}
        <div class="flex flex-col md:flex-row">
            @include('layouts/dashboard.sidebar')
        
            @yield('content')
        </div>
    </body>
</html>