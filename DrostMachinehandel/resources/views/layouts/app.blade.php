<html>
    <head>
        {{-- HTML --}}
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        {{-- Page title tag --}}
        <title>Drost Machinehandel - {{ ucfirst(Route::currentRouteName()) }}</title>

        {{-- Fontawesome --}}
        <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>

        @vite(['resources/scss/main.scss', 'resources/js/app.js', 'node_modules/flowbite/dist/flowbite.js'])
      
        <script type="text/javascript">
            (function(){h=document.getElementsByTagName('head')[0];s=document.createElement('script');
            s.type='text/javascript';s.src="https://www.voorraadmodule.nl/js/svm.js?t="+Date.now();s.onload=function(){
            svm.saveUrlGetData({key: 'svm_canvas_width', value:document.getElementById('svm-canvas').clientWidth});
            vm=svm.create('4033','https://www.voorraadmodule.nl/',false, {'carousel': false, 'carouselOptions': {'direction': false, 'amount': false}, 'quick_search': false}, 'default');
            vm.init();};h.appendChild(s);})();
        </script>
    </head>
    <body class="bg-black text-white flex flex-col min-h-screen page-{{ Route::currentRouteName() }}">
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