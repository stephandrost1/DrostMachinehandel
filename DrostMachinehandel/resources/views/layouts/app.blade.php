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
    
            {{-- Fontawesome --}}
            <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    
            {{-- Flowbite --}}
            <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
            <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
    
            {{-- Required custom scss and js --}}
            @vite(['resources/scss/main.scss', 'resources/js/app.js', 'resources/vue/app.js'])
          
            <script type="text/javascript">
                (function(){h=document.getElementsByTagName('head')[0];s=document.createElement('script');
                s.type='text/javascript';s.src="https://www.voorraadmodule.nl/js/svm.js?t="+Date.now();s.onload=function(){
                svm.saveUrlGetData({key: 'svm_canvas_width', value:document.getElementById('svm-canvas').clientWidth});
                svm.saveUrlGetData({key: 'svm_sellang', value:document.querySelector('meta[name="current-lang"]').content});
                vm=svm.create('4033','https://www.voorraadmodule.nl/',false, {'carousel': false, 'carouselOptions': {'direction': false, 'amount': false}, 'quick_search': false}, 'default');
                vm.init();};h.appendChild(s);})();
            </script>
        </head>
        <body class="bg-black text-white flex flex-col min-h-screen page-{{ Route::currentRouteName() }}">
            {{-- Navbar --}}
            @include('layouts.navbar', [
                "currentLang" => App::getLocale()
            ])
     
            {{-- Page content --}}
            <div class="flex-1">
                @yield('content')
            </div>
    
            @if(!request()->is('login') && !request()->is('dealer/login') && !request()->is('dealer/create-account'))
            
                {{-- Footer --}}
                @include('layouts.footer', [
                    "currentLang" => App::getLocale()
                ])

            @endif
            
            
        </body>
    </html>