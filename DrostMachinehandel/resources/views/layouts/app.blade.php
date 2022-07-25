<html>
    <head>
        {{-- Page title tag --}}
        <title>Drost Machinehandel - @yield('title')</title>

        {{-- Scripts --}}

        {{-- Tailwind CSS --}}
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
              theme: {
                extend: {
                  colors: {
                    primary: '#E56D01',
                    secondary: '#707070',
                  }
                }
              }
            }
          </script>
        
    </head>
    <body>
        {{-- Navbar --}}
        @include('layouts.navbar')
 
        <div class="container">
            @yield('content')
        </div>

        {{-- Footer --}}
        @include('layouts.footer')
    </body>
</html>