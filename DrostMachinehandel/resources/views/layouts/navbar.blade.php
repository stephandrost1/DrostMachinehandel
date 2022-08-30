<style>
    #language-dropdown-menu {
        margin-top: 15px !important;
    }

    .lang-dropdown:after,
    .lang-dropdown:before {
    bottom: 100%;
    border: solid transparent;
    content: "";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
    }

    .lang-dropdown:after {
    border-color: rgba(255, 255, 255, 0);
    border-bottom-color: #707070;
    border-width: 19px;
    right: 0;
    margin-top: 5px
    }

</style>

<div class="z-20 homepage-video-style">
    {{-- Orange header --}}
    <div class="flex items-center justify-center gap-28 bg-primary h-10 w-full text-white font-extrabold text-xl">
        <div class="flex items-center gap-2"><i class="fas fa-concierge-bell"></i> Service aan verkochte machines</div>
        {{-- <div class="flex items-center gap-2"><i class="fas fa-sort-amount-up"></i> Grote voorraad</div>
        <div class="flex items-center gap-2"><i class="fas fa-dolly"></i> Transport naar locatie</div>
        <div class="flex items-center gap-2"><i class="fas fa-exchange-alt"></i> Inruil mogelijk</div> --}}
    </div>

    {{-- Desktop / Tablet Navbar --}}
    <nav style="background-color: rgba(0, 0, 0, 0.6);" class="hidden md:block py-5">
      <div class="flex flex-wrap justify-between justify-content-end items-center mx-12 xl:mx-16">
        <a href="https://drostmachinehandel.com/" class="flex items-center">
            <img src="{{ asset('/img/logo.png') }}" class="mr-3 h-12 md:h-16" alt="logo" />
        </a>

          <div class="flex gap-10 xl:gap-20">
            <button id="dropdownDefault" data-dropdown-toggle="dropdown" class="flex items-center justify-center gap-2" type="button">
              <img class="h-5 w-7" src="{{ asset('img/flags/NL-flag.png') }}" alt="NL-flag"> 
              <i class="fas fa-chevron-down text-2xl"></i>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdown" class="hidden z-10 w-fit px-2 py-1 bg-secondary lang-dropdown">
                <ul class="py-1 text-sm text-gray-700 flex flex-col gap-3 items-center justify-center" aria-labelledby="dropdownDefault">
                  <li class="flex items-center gap-2 text-white text-lg font-bold">
                    <img class="h-5 w-7" src="{{ asset('img/flags/EN-flag.png') }}" alt="EN-flag"> EN
                  </li>
                  <li class="flex items-center gap-2 text-white text-lg font-bold">
                    <img class="h-5 w-7" src="{{ asset('img/flags/FR-flag.png') }}" alt="FR-flag"> FR
                  </li>
                  <li class="flex items-center gap-2 text-white text-lg font-bold">
                    <img class="h-5 w-7" src="{{ asset('img/flags/DE-flag.png') }}" alt="DE-flag"> DE
                  </li>
                </ul>
            </div>
            <div class="text-lg xl:text-2xl font-bold @if(Request::is('/')) border-b-2 border-primary md:border-b-[4px] @endif">Home</div>
            <div class="text-lg xl:text-2xl font-bold @if(Request::is('voorraad')) border-b-2 border-primary md:border-b-[4px] @endif">Voorraad</div>
            <div class="text-lg xl:text-2xl font-bold @if(Request::is('leasen')) border-b-2 border-primary md:border-b-[4px] @endif">Leasen</div>
            <div class="text-lg xl:text-2xl font-bold @if(Request::is('contact')) border-b-2 border-primary md:border-b-[4px] @endif">Contact</div>
        </div>
      </div>
    </nav>

    {{-- Mobile Navbar --}}
    <nav id="navbar" style="background-color: rgba(0, 0, 0, 0.6);" class="block md:hidden py-5 z-50">
      <div class="flex flex-wrap justify-between justify-content-end items-center mx-5">
        <a href="https://drostmachinehandel.com/" class="flex items-center">
            <img src="{{ asset('/img/logo.png') }}" class="mr-3 h-12 md:h-16" alt="logo" />
        </a>

          <div class="">
            <i id="hamburger-icon" class="fas fa-bars text-3xl"></i>
        </div>
      </div>
    </nav>

</div>