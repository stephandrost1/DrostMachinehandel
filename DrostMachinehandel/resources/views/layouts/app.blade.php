<html>
    <head>

        {{-- HTML --}}
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        {{-- Page title tag --}}
        <title>Drost Machinehandel - @yield('title')</title>

        {{-- SwiperJS --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
        <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

        {{-- Fontawesome --}}
        <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>

        {{-- Flowbite --}}
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.1/dist/flowbite.min.css" />
        <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>

        {{-- Tailwind CSS --}}
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
              theme: {
                extend: {
                  colors: {
                    primary: '#E56D01',
                    secondary: '#707070',
                  },
                  animation: {
                    'bounce-slow': 'bounce 3s linear infinite',
                  }
                }
              }
            }
          </script>
        
    </head>
    <style>
      * {
        -webkit-tap-highlight-color: transparent;
        font-family: candara;
      }

      /* width */
      ::-webkit-scrollbar {
        width: 10px;
      }

      /* Track */
      ::-webkit-scrollbar-track {
        background: #0000; 
      }
      
      /* Handle */
      ::-webkit-scrollbar-thumb {
        background: #707070; 
      }
    </style>
    <body class="bg-black text-white flex flex-col min-h-screen">
        {{-- Navbar --}}
        @include('layouts.navbar')
 
        {{-- Page content --}}
        <div class="flex-1">
            @yield('content')
        </div>

        {{-- Footer --}}
        @include('layouts.footer')
    </body>
</html>