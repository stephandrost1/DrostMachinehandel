<div class="z-20 homepage-video-style">
    {{-- Orange header --}}
    <div class="swiper h-fit swiper-container-element">
      <div class="swiper-wrapper h-10 w-full text-white font-extrabold text-xl">
        <div class="swiper-slide bg-primary"><div class="swiper-content mx-auto w-fit py-3 flex items-center gap-2"><i class="fas fa-concierge-bell"></i> {{ __('content/navbar.machine-service') }}</div></div>
        <div class="swiper-slide bg-primary"><div class="swiper-content mx-auto w-fit py-3 flex items-center gap-2"><i class="fas fa-sort-amount-up"></i> {{ __('content/navbar.available-stock') }}</div></div>
        <div class="swiper-slide bg-primary"><div class="swiper-content mx-auto w-fit py-3 flex items-center gap-2"><i class="fas fa-dolly"></i> {{ __('content/navbar.transport') }}</div></div>
        <div class="swiper-slide bg-primary"><div class="swiper-content mx-auto w-fit py-3 flex items-center gap-2"><i class="fas fa-exchange-alt"></i> {{ __('content/navbar.trade-in') }}</div></div>
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
              @if ($currentLang == 'nl')<img class="h-5 w-7" src="{{ asset('img/flags/NL-flag.png') }}" alt="NL-flag"> @endif
              @if ($currentLang == 'en')<img class="h-5 w-7" src="{{ asset('img/flags/EN-flag.png') }}" alt="EN-flag"> @endif
              @if ($currentLang == 'fr')<img class="h-5 w-7" src="{{ asset('img/flags/FR-flag.png') }}" alt="FR-flag"> @endif
              @if ($currentLang == 'de')<img class="h-5 w-7" src="{{ asset('img/flags/DE-flag.png') }}" alt="DE-flag"> @endif
              <i class="fas fa-chevron-down text-2xl"></i>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdown" class="langDropdownDesktop hidden z-10 w-fit px-2 py-1 bg-secondary lang-dropdown">
                <ul class="py-1 text-sm text-gray-700 flex flex-col gap-3 items-center justify-center" aria-labelledby="dropdownDefault">
                  @if ($currentLang != 'nl')
                    <li class="flex items-center gap-2 text-white text-lg font-bold">
                      <a class="flex items-center gap-2" href="{{ route('locale.setting', 'nl') }}">
                        <img class="h-5 w-7" src="{{ asset('img/flags/NL-flag.png') }}" alt="NL-flag"> NL
                      </a>
                    </li>
                  @endif
                  @if ($currentLang != 'en')
                    <li class="flex items-center gap-2 text-white text-lg font-bold">
                      <a class="flex items-center gap-2" href="{{ route('locale.setting', 'en') }}">
                        <img class="h-5 w-7" src="{{ asset('img/flags/EN-flag.png') }}" alt="EN-flag"> EN
                      </a>
                    </li>
                  @endif
                  @if ($currentLang != 'fr')
                    <li class="flex items-center gap-2 text-white text-lg font-bold">
                      <a class="flex items-center gap-2" href="{{ route('locale.setting', 'fr') }}">
                        <img class="h-5 w-7" src="{{ asset('img/flags/FR-flag.png') }}" alt="FR-flag"> FR
                      </a>
                    </li>
                  @endif
                  
                  @if ($currentLang != 'de')
                    <li class="flex items-center gap-2 text-white text-lg font-bold">
                      <a class="flex items-center gap-2" href="{{ route('locale.setting', 'de') }}">
                        <img class="h-5 w-7" src="{{ asset('img/flags/DE-flag.png') }}" alt="DE-flag"> DE
                      </a>
                    </li>
                  @endif
                </ul>
            </div>

            <a href={{ route("home") }}><div class="text-lg xl:text-2xl font-bold @if(Request::is('/')) border-b-2 border-primary md:border-b-[4px] @endif">{{ __('content/navbar.home') }}</div></a>
            <a href={{ route("voorraad") }}><div class="text-lg xl:text-2xl font-bold @if(Request::is('voorraad')) border-b-2 border-primary md:border-b-[4px] @endif">{{ __('content/navbar.stock') }}</div></a>
            <a href={{ route("verhuur") }}><div class="text-lg xl:text-2xl font-bold @if(Request::is('verhuur')) border-b-2 border-primary md:border-b-[4px] @endif">{{ __('content/navbar.rent') }}</div></a>
            <a href={{ route("leasen") }}><div class="text-lg xl:text-2xl font-bold @if(Request::is('leasen')) border-b-2 border-primary md:border-b-[4px] @endif">{{ __('content/navbar.lease') }}</div></a>
            <a href={{ route("contact") }}><div class="text-lg xl:text-2xl font-bold @if(Request::is('contact')) border-b-2 border-primary md:border-b-[4px] @endif">{{ __('content/navbar.contact') }}</div></a>
            <a href={{ route("dashboard") }}><div class="text-lg xl:text-2xl font-bold @if(Request::is('dashboard')) border-b-2 border-primary md:border-b-[4px] @endif">{{ __('content/navbar.login') }}</div></a>
        </div>
      </div>
    </nav>

    {{-- Mobile Navbar --}}
    <nav id="navbar" style="background-color: rgba(0, 0, 0, 0.6);" class="block md:hidden py-5 z-50">
      <div class="flex flex-wrap justify-between justify-content-end items-center mx-8">
        <a href="https://drostmachinehandel.com/" class="nav-logo 
         flex items-center">
            <img src="{{ asset('/img/logo.png') }}" class="mr-3 h-12 md:h-16 navbar-logo" alt="logo" />
        </a>

        <div class="flex gap-5 sm:gap-10 items-center">
          <div>
            <button id="dropdownMobileButton" data-dropdown-toggle="dropdownMobile" class="flex items-center justify-center gap-2" type="button">
              @if ($currentLang == 'nl')<img class="h-5 w-7" src="{{ asset('img/flags/NL-flag.png') }}" alt="NL-flag"> @endif
              @if ($currentLang == 'en')<img class="h-5 w-7" src="{{ asset('img/flags/EN-flag.png') }}" alt="EN-flag"> @endif
              @if ($currentLang == 'fr')<img class="h-5 w-7" src="{{ asset('img/flags/FR-flag.png') }}" alt="FR-flag"> @endif
              @if ($currentLang == 'de')<img class="h-5 w-7" src="{{ asset('img/flags/DE-flag.png') }}" alt="DE-flag"> @endif
              <i class="fas fa-chevron-down text-2xl"></i>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdownMobile" class="hidden langDropdownMobile z-10 w-fit px-2 py-1 bg-secondary lang-dropdown">
                <ul class="py-1 text-sm text-gray-700 flex flex-col gap-3 items-center justify-center" aria-labelledby="langdropdownDefault">
                  @if ($currentLang != 'nl')
                    <li class="flex items-center gap-2 text-white text-lg font-bold">
                      <a class="flex items-center gap-2" href="{{ route('locale.setting', 'nl') }}">
                        <img class="h-5 w-7" src="{{ asset('img/flags/NL-flag.png') }}" alt="NL-flag"> NL
                      </a>
                    </li>
                  @endif
                  @if ($currentLang != 'en')
                    <li class="flex items-center gap-2 text-white text-lg font-bold">
                      <a class="flex items-center gap-2" href="{{ route('locale.setting', 'en') }}">
                        <img class="h-5 w-7" src="{{ asset('img/flags/EN-flag.png') }}" alt="EN-flag"> EN
                      </a>
                    </li>
                  @endif
                  @if ($currentLang != 'fr')
                    <li class="flex items-center gap-2 text-white text-lg font-bold">
                      <a class="flex items-center gap-2" href="{{ route('locale.setting', 'fr') }}">
                        <img class="h-5 w-7" src="{{ asset('img/flags/FR-flag.png') }}" alt="FR-flag"> FR
                      </a>
                    </li>
                  @endif
                  
                  @if ($currentLang != 'de')
                    <li class="flex items-center gap-2 text-white text-lg font-bold">
                      <a class="flex items-center gap-2" href="{{ route('locale.setting', 'de') }}">
                        <img class="h-5 w-7" src="{{ asset('img/flags/DE-flag.png') }}" alt="DE-flag"> DE
                      </a>
                    </li>
                  @endif
                </ul>
            </div>
            
          </div>
          <div class="hamburger-icon-wrapper">
            <div class="hamburger-wrapper">
              <div class="line line-1"></div>
              <div class="line line-2"></div>
              <div class="line line-3"></div>
            </div>
          </div>
        </div>

        
        <div id="navbar-expanded-mobile" class="navbar-expanded">
          <div class="menu-list">
            <ul>
              <li>
                <a href={{ route("home") }}>
                  <div class="navbar-item @if(Request::is('/')) active @endif">{{ __('content/navbar.home') }}</div>
                </a>
              </li>
              <li>
                <a href={{ route("voorraad") }}>
                  <div class="navbar-item @if(Request::is('voorraad')) active @endif">{{ __('content/navbar.stock') }}</div>
                </a>
              </li>
              <li>
                <a href={{ route("verhuur") }}>
                  <div class="navbar-item @if(Request::is('verhuur')) active @endif">{{ __('content/navbar.rent') }}</div>
                </a>
              </li>
              <li>
                <a href={{ route("leasen") }}>
                  <div class="navbar-item @if(Request::is('leasen')) active @endif">{{ __('content/navbar.lease') }}</div>
                </a>
              </li>
              <li>
                <a href={{ route("contact") }}>
                  <div class="navbar-item @if(Request::is('contact')) active @endif">{{ __('content/navbar.contact') }}</div>
                </a>
              </li>
              <li>
                <a href={{ route("dashboard") }}>
                  <div class="navbar-item @if(Request::is('dashboard')) active @endif">{{ __('content/navbar.login') }}</div>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav> 
</div>