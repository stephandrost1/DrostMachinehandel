<html>
    <head>
        <title>Drost Machinehandel - @yield('title')</title>
    </head>
    <body>
        @include('layouts.navbar')
 
        <div class="container">
            @yield('content')
        </div>

        @include('layouts.footer')
    </body>
</html>