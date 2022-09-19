<div class="z-20 homepage-video-style">
    {{-- Orange header --}}
    <div class="swiper h-fit swiper-container-element">
      <div class="swiper-wrapper h-10 w-full text-white font-extrabold text-xl">
        <div class="swiper-slide bg-primary"><div class="swiper-content mx-auto w-fit py-3 flex items-center gap-2"><i class="fas fa-concierge-bell"></i> Service aan verkochte machines</div></div>
        <div class="swiper-slide bg-primary"><div class="swiper-content mx-auto w-fit py-3 flex items-center gap-2"><i class="fas fa-sort-amount-up"></i> Grote voorraad</div></div>
        <div class="swiper-slide bg-primary"><div class="swiper-content mx-auto w-fit py-3 flex items-center gap-2"><i class="fas fa-dolly"></i> Transport naar locatie</div></div>
        <div class="swiper-slide bg-primary"><div class="swiper-content mx-auto w-fit py-3 flex items-center gap-2"><i class="fas fa-exchange-alt"></i> Inruil mogelijk</div></div>
      </div>
    </div>

    {{-- Desktop / Tablet Navbar --}}
    <nav style="background-color: rgba(0, 0, 0, 0.6);" class="hidden md:block py-5">
      <div class="flex flex-wrap justify-between justify-content-end items-center mx-12 xl:mx-16">
        <a href="https://drostmachinehandel.com/" class="flex items-center">
            <img src="{{ asset('/img/logo.png') }}" class="mr-3 h-12 md:h-16" alt="logo" />
        </a>

          <div class="flex gap-10 xl:gap-20 language-selector">
            <button id="dropdownDefault" data-dropdown-toggle="dropdown" class="flex items-center justify-center gap-2" type="button">
              <img onclick="{{ App::setLocale("nl") }}" class="h-5 w-7" src="{{ asset('img/flags/NL-flag.png') }}" alt="NL-flag"> 
              <i class="fas fa-chevron-down text-2xl"></i>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdown" class="hidden z-10 w-fit px-2 py-1 bg-secondary lang-dropdown">
                <ul class="py-1 text-sm text-gray-700 flex flex-col gap-3 items-center justify-center" aria-labelledby="dropdownDefault">
                  <li onclick="{{ App::setLocale("en") }}" class="flex items-center gap-2 text-white text-lg font-bold">
                    <a href="#">
                      <img class="h-5 w-7" src="{{ asset('img/flags/EN-flag.png') }}" alt="EN-flag"> EN
                    </a>
                  </li>
                  <li class="flex items-center gap-2 text-white text-lg font-bold">
                    <a href="#">
                      <img class="h-5 w-7" src="{{ asset('img/flags/FR-flag.png') }}" alt="FR-flag"> FR
                    </a>
                  </li>
                  <li class="flex items-center gap-2 text-white text-lg font-bold">
                    <a href="#">
                      <img class="h-5 w-7" src="{{ asset('img/flags/DE-flag.png') }}" alt="DE-flag"> DE
                    </a>
                  </li>
                </ul>
            </div>


            <a href="{{ route('locale.setting', 'nl') }}">
              NL
            </a>
            <a href="{{ route('locale.setting', 'en') }}">
              EN
            </a>
            <a href="{{ route('locale.setting', 'de') }}">
              DE
            </a>
            <a href="{{ route('locale.setting', 'fr') }}">
              FR
            </a>


            <a hreflang="{{ App::getLocale() }}" href={{ route("home") }}><div class="text-lg xl:text-2xl font-bold @if(Request::is('/')) border-b-2 border-primary md:border-b-[4px] @endif">{{ __('content/navbar.home') }}</div></a>
            <a hreflang="{{ App::getLocale() }}" href={{ route("voorraad") }}><div class="text-lg xl:text-2xl font-bold @if(Request::is('voorraad')) border-b-2 border-primary md:border-b-[4px] @endif">{{ __('content/navbar.stock') }}</div></a>
            <a hreflang="{{ App::getLocale() }}" href={{ route("leasen") }}><div class="text-lg xl:text-2xl font-bold @if(Request::is('leasen')) border-b-2 border-primary md:border-b-[4px] @endif">{{ __('content/navbar.lease') }}</div></a>
            <a hreflang="{{ App::getLocale() }}" href={{ route("contact") }}><div class="text-lg xl:text-2xl font-bold @if(Request::is('contact')) border-b-2 border-primary md:border-b-[4px] @endif">{{ __('content/navbar.contact') }}</div></a>
        </div>
      </div>
    </nav>

    {{-- Mobile Navbar --}}
    <nav id="navbar" style="background-color: rgba(0, 0, 0, 0.6);" class="block md:hidden py-5 z-50">
      <div class="flex flex-wrap justify-between justify-content-end items-center mx-5">
        <a href="https://drostmachinehandel.com/" class="nav-logo 
         flex items-center">
            <img src="{{ asset('/img/logo.png') }}" class="mr-3 h-12 md:h-16" alt="logo" />
        </a>

        <div class="hamburger-icon-wrapper">
          <div class="hamburger-wrapper">
            <div class="line line-1"></div>
            <div class="line line-2"></div>
            <div class="line line-3"></div>
          </div>
        </div>
        <div id="navbar-expanded-mobile" class="navbar-expanded">
          <div class="menu-list">
            <ul>
              <li>
                <a href={{ route("home") }}>
                  <div class="text-lg xl:text-2xl font-bold @if(Request::is('/')) border-b-2 border-primary md:border-b-[4px] @endif">Home</div>
                </a>
              </li>
              <li>
                <a href={{ route("voorraad") }}>
                  <div class="text-lg xl:text-2xl font-bold @if(Request::is('voorraad')) border-b-2 border-primary md:border-b-[4px] @endif">Voorraad</div>
                </a>
              </li>
              <li>
                <a href={{ route("leasen") }}>
                  <div class="text-lg xl:text-2xl font-bold @if(Request::is('leasen')) border-b-2 border-primary md:border-b-[4px] @endif">Leasen</div>
                </a>
              </li>
              <li>
                <a href={{ route("contact") }}>
                  <div class="text-lg xl:text-2xl font-bold @if(Request::is('contact')) border-b-2 border-primary md:border-b-[4px] @endif">Contact</div>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav> 
</div>