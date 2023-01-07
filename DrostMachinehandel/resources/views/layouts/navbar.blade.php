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
    <nav style="background-color: rgba(0, 0, 0, 0.6);" class="desktop-visibility py-5">
      <div class="flex flex-wrap justify-between justify-content-end items-center mx-12 xl:mx-16">
        <a href="https://drostmachinehandel.com/" class="flex items-center">
            <img src="{{ asset('/img/logo.png') }}" class="mr-3 h-12 md:h-16" alt="logo" />
        </a>
        <div class="flex desktop-gap items-center language-selector">
          <div class="group relative lang-dropdown">
            <button
              class="inline-flex items-center text-xl xl:text-2xl font-bold"
            >
            @if ($currentLang == 'nl')<img class="h-5 w-7 mr-2" src="{{ asset('img/flags/NL-flag.png') }}" alt="NL-flag"> @endif
            @if ($currentLang == 'en')<img class="h-5 w-7 mr-2" src="{{ asset('img/flags/EN-flag.png') }}" alt="EN-flag"> @endif
            @if ($currentLang == 'fr')<img class="h-5 w-7 mr-2" src="{{ asset('img/flags/FR-flag.png') }}" alt="FR-flag"> @endif
            @if ($currentLang == 'de')<img class="h-5 w-7 mr-2" src="{{ asset('img/flags/DE-flag.png') }}" alt="DE-flag"> @endif
              <i class="fas fa-chevron-down"></i>
            </button>
            <ul class="lang-borders absolute w-full hidden text-gray-700 pt-1 group-hover:block">
              @if ($currentLang != 'nl')
                <li>
                  <a
                    class="bg-secondary flex flex-col items-center font-bold hover:bg-gray-600 text-white py-2 px-4 whitespace-no-wrap"
                    href="{{ route('locale.setting', 'nl') }}"
                    ><img class="h-5 w-7" src="{{ asset('img/flags/NL-flag.png') }}" alt="NL-flag"> NL</a
                  >
                </li>
              @endif
              @if ($currentLang != 'en')
                <li>
                  <a
                    class="bg-secondary flex flex-col items-center font-bold hover:bg-gray-600 text-white py-2 px-4 whitespace-no-wrap"
                    href="{{ route('locale.setting', 'en') }}"
                    ><img class="h-5 w-7" src="{{ asset('img/flags/EN-flag.png') }}" alt="EN-flag"> EN</a
                  >
                </li>
              @endif
              @if ($currentLang != 'fr')
                <li>
                  <a
                    class="bg-secondary flex flex-col items-center font-bold hover:bg-gray-600 text-white py-2 px-4 whitespace-no-wrap "
                    href="{{ route('locale.setting', 'fr') }}"
                    ><img class="h-5 w-7" src="{{ asset('img/flags/FR-flag.png') }}" alt="FR-flag"> FR</a
                  >
                </li>
              @endif
              @if ($currentLang != 'de')
                <li>
                  <a
                    class="bg-secondary flex flex-col items-center font-bold hover:bg-gray-600 text-white py-2 px-4 whitespace-no-wrap "
                    href="{{ route('locale.setting', 'de') }}"
                    ><img class="h-5 w-7" src="{{ asset('img/flags/DE-flag.png') }}" alt="DE-flag"> DE</a
                  >
                </li>
              @endif
            </ul>
          </div>

            <a href={{ route("home") }}><div class="text-xl xl:text-2xl font-bold @if(Request::is('/')) border-b-2 border-primary md:border-b-[4px] @endif">{{ __('content/navbar.home') }}</div></a>
            <div class="group inline-block relative">
              <button class="inline-flex items-center text-xl xl:text-2xl font-bold @if(Request::is('voorraad') || Request::is('dealer/voorraad')) border-b-2 border-primary md:border-b-[4px] @endif">
                <span class="mr-1">{{ __('content/navbar.occasions') }}</span>
                <i class="fas fa-chevron-down"></i>
              </button>
              <ul class="absolute w-full hidden text-gray-700 pt-1 group-hover:block">
                <li>
                  <a class="rounded-t bg-secondary font-bold hover:bg-gray-600 text-white py-2 px-4 block whitespace-no-wrap @if(Request::is('voorraad')) underline decoration-primary underline-offset-2 decoration-2 @endif" href="{{ route("voorraad") }}">{{ __('content/navbar.private-individual') }}</a>
                </li>
                <li>
                  <a
                    class="rounded-b bg-secondary font-bold hover:bg-gray-600 text-white py-2 px-4 block whitespace-no-wrap @if(Request::is('dealer/voorraad')) underline decoration-primary underline-offset-2 decoration-2 @endif"
                    href="{{ route("dealer-voorraad") }}"
                    >{{ __('content/navbar.traders') }}</a
                  >
                </li>
              </ul>
            </div>
            <a href={{ route("verhuur") }}><div class="text-xl xl:text-2xl font-bold @if(Request::is('verhuur')) border-b-2 border-primary md:border-b-[4px] @endif">{{ __('content/navbar.rent') }}</div></a>
            <a href={{ route("leasen") }}><div class="text-xl xl:text-2xl font-bold @if(Request::is('leasen')) border-b-2 border-primary md:border-b-[4px] @endif">{{ __('content/navbar.lease') }}</div></a>
            <a href={{ route("contact") }}><div class="text-xl xl:text-2xl font-bold @if(Request::is('contact')) border-b-2 border-primary md:border-b-[4px] @endif">{{ __('content/navbar.contact') }}</div></a>
            @if (Auth::check())
            {{-- todo clean this code --}}
            <div class="group inline-block relative">
              <button class="inline-flex items-center text-xl xl:text-2xl font-bold @if(Request::is('voorraad') || Request::is('dealer/voorraad')) border-b-2 border-primary md:border-b-[4px] @endif">
                <span class="mr-1">{{  __('content/navbar.account') }}</span>
                <i class="fas fa-chevron-down"></i>
              </button>
              <ul class="absolute w-full hidden text-gray-700 pt-1 group-hover:block">
                <li>
                  <a class="rounded-t bg-secondary font-bold hover:bg-gray-600 text-white py-2 px-4 block whitespace-no-wrap @if(Request::is('dashboard-account')) underline decoration-primary underline-offset-2 decoration-2 @endif" href="{{ route("dashboard-account") }}">{{ __('content/navbar.dashboard-account') }}</a>
                </li>
                <li>
                  <form class="rounded-b bg-secondary font-bold hover:bg-gray-600 text-white py-2 px-4 block whitespace-no-wrap" action="{{ route("logout") }}" method="POST">
                  @csrf
                  <button type="submit" class="font-bold">{{ __('content/navbar.logout') }}</button>
                </form>
                </li>
              </ul>
            </div>
            
            @else
              <div class="group inline-block relative">
                <button
                  class="inline-flex items-center text-xl xl:text-2xl font-bold @if(Request::is('login') || Request::is('dealer/login')) border-b-2 border-primary md:border-b-[4px] @endif"
                >
                  <span class="mr-1">{{ __('content/navbar.login') }}</span>
                  <i class="fas fa-chevron-down"></i>
                </button>
                <ul class="absolute w-full hidden text-gray-700 pt-1 group-hover:block">
                  <li>
                    <a
                      class="rounded-t bg-secondary font-bold hover:bg-gray-600 text-white py-2 px-4 block whitespace-no-wrap @if(Request::is('login')) underline decoration-primary underline-offset-2 decoration-2 @endif"
                      href="{{ route("login") }}"
                      >{{ __('content/navbar.admin-login') }}</a
                    >
                  </li>
                  <li>
                    <a
                      class="rounded-b bg-secondary font-bold hover:bg-gray-600 text-white py-2 px-4 block whitespace-no-wrap @if(Request::is('dealer/login')) underline decoration-primary underline-offset-2 decoration-2 @endif"
                      href="{{ route("dealer-login") }}"
                      >{{ __('content/navbar.dealer-login') }}</a
                    >
                  </li>
                </ul>
              </div>
            @endif
          </div>
      </div>
    </nav>

    {{-- Mobile Navbar --}}
    <nav id="navbar" style="background-color: rgba(0, 0, 0, 0.6);" class="mobile-visibility py-5 z-50">
      <div class="flex flex-wrap justify-between justify-content-end items-center mx-8">
        <a href="https://drostmachinehandel.com/" class="nav-logo 
         flex items-center">
            <img src="{{ asset('/img/logo.png') }}" class="mr-3 h-12 md:h-16 navbar-logo" alt="logo" />
        </a>

        <div class="flex gap-5 sm:gap-10 items-center">
          <div class="group relative lang-dropdown z-20">
            <button
              class="inline-flex items-center text-2xl font-bold"
            >
            @if ($currentLang == 'nl')<img class="h-5 w-7 mr-2" src="{{ asset('img/flags/NL-flag.png') }}" alt="NL-flag"> @endif
            @if ($currentLang == 'en')<img class="h-5 w-7 mr-2" src="{{ asset('img/flags/EN-flag.png') }}" alt="EN-flag"> @endif
            @if ($currentLang == 'fr')<img class="h-5 w-7 mr-2" src="{{ asset('img/flags/FR-flag.png') }}" alt="FR-flag"> @endif
            @if ($currentLang == 'de')<img class="h-5 w-7 mr-2" src="{{ asset('img/flags/DE-flag.png') }}" alt="DE-flag"> @endif
              <i class="fas fa-chevron-down"></i>
            </button>
            <ul class="lang-borders absolute w-full hidden text-gray-700 pt-1 group-hover:block">
              @if ($currentLang != 'nl')
                <li>
                  <a
                    class="bg-secondary flex flex-col items-center font-bold hover:bg-gray-600 text-white py-2 px-4 whitespace-no-wrap"
                    href="{{ route('locale.setting', 'nl') }}"
                    ><img class="h-5 w-7" src="{{ asset('img/flags/NL-flag.png') }}" alt="NL-flag"> NL</a
                  >
                </li>
              @endif
              @if ($currentLang != 'en')
                <li>
                  <a
                    class="bg-secondary flex flex-col items-center font-bold hover:bg-gray-600 text-white py-2 px-4 whitespace-no-wrap"
                    href="{{ route('locale.setting', 'en') }}"
                    ><img class="h-5 w-7" src="{{ asset('img/flags/EN-flag.png') }}" alt="EN-flag"> EN</a
                  >
                </li>
              @endif
              @if ($currentLang != 'fr')
                <li>
                  <a
                    class="bg-secondary flex flex-col items-center font-bold hover:bg-gray-600 text-white py-2 px-4 whitespace-no-wrap "
                    href="{{ route('locale.setting', 'fr') }}"
                    ><img class="h-5 w-7" src="{{ asset('img/flags/FR-flag.png') }}" alt="FR-flag"> FR</a
                  >
                </li>
              @endif
              @if ($currentLang != 'de')
                <li>
                  <a
                    class="bg-secondary flex flex-col items-center font-bold hover:bg-gray-600 text-white py-2 px-4 whitespace-no-wrap "
                    href="{{ route('locale.setting', 'de') }}"
                    ><img class="h-5 w-7" src="{{ asset('img/flags/DE-flag.png') }}" alt="DE-flag"> DE</a
                  >
                </li>
              @endif
            </ul>
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
              <li class="border-b-2 border-secondary ml-4 @if(Request::is('voorraad') || Request::is('dealer/voorraad')) !border-primary @endif">
                <div class="group inline-block relative w-full mt-8 font-bold pb-2">
                  <button
                    class="inline-flex items-center text-xl xl:text-2xl font-bold"
                  >
                    <span class="mr-1 text-[2rem]">{{ __('content/navbar.occasions') }}</span>
                    <i class="fas fa-chevron-down"></i>
                  </button>
                  <ul class="absolute w-full hidden text-gray-700 pt-1 group-hover:block">
                    <li>
                      <a
                        class="rounded-t bg-secondary font-bold hover:bg-gray-600 text-white py-2 px-4 block whitespace-no-wrap @if(Request::is('voorraad')) underline decoration-primary underline-offset-2 decoration-2 @endif"
                        href="{{ route("voorraad") }}"
                        >{{ __('content/navbar.occasions') }}</a
                      >
                    </li>
                    <li>
                      <a
                        class="rounded-b bg-secondary font-bold hover:bg-gray-600 text-white py-2 px-4 block whitespace-no-wrap @if(Request::is('dealer/voorraad')) underline decoration-primary underline-offset-2 decoration-2 @endif"
                        href="{{ route("dealer-voorraad") }}"
                        >{{ __('content/navbar.private-individual') }}</a
                      >
                    </li>
                  </ul>
                </div>
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
              @if (Auth::check())
                <li class="border-b-2 border-secondary ml-4 @if(Request::is('login') || Request::is('dealer/login')) !border-primary @endif">
                  <div class="group inline-block relative w-full mt-8 font-bold pb-2">
                    <button
                      class="inline-flex items-center text-xl xl:text-2xl font-bold "
                    >
                      <span class="mr-1 text-[2rem]">{{  __('content/navbar.account') }}</span>
                      <i class="fas fa-chevron-down"></i>
                    </button>
                    <ul class="absolute w-full hidden text-gray-700 pt-1 group-hover:block">
                      <li>
                        <a
                          class="rounded-t bg-secondary font-bold hover:bg-gray-600 text-white py-2 px-4 block whitespace-no-wrap @if(Request::is('voorraad')) underline decoration-primary underline-offset-2 decoration-2 @endif"
                          href="{{ route("dashboard") }}"
                          >Dashboard</a
                        >
                      </li>
                      <li>
                        <form
                          
                          method="POST" action="{{ route('logout') }}"
                          class="rounded-b bg-secondary font-bold hover:bg-gray-600 text-white py-2 px-4 block whitespace-no-wrap""
                          >@csrf<button type="submit">{{ __('content/navbar.logout') }}</button></form
                        >
                      </li>
                    </ul>
                  </div>
                </li>
              @else
                <li class="border-b-2 border-secondary ml-4 @if(Request::is('login') || Request::is('dealer/login')) !border-primary @endif">
                  <div class="group inline-block relative w-full mt-8 font-bold pb-2">
                    <button
                      class="inline-flex items-center text-xl xl:text-2xl font-bold "
                    >
                      <span class="mr-1 text-[2rem]">{{ __('content/navbar.login') }}</span>
                      <i class="fas fa-chevron-down"></i>
                    </button>
                    <ul class="absolute w-full hidden text-gray-700 pt-1 group-hover:block">
                      <li>
                        <a
                          class="rounded-t bg-secondary font-bold hover:bg-gray-600 text-white py-2 px-4 block whitespace-no-wrap @if(Request::is('login')) underline decoration-primary underline-offset-2 decoration-2 @endif"
                          href="{{ route("login") }}"
                          >{{ __('content/navbar.admin-login') }}</a
                        >
                      </li>
                      <li>
                        <a
                          class="rounded-b bg-secondary font-bold hover:bg-gray-600 text-white py-2 px-4 block whitespace-no-wrap @if(Request::is('dealer/login')) underline decoration-primary underline-offset-2 decoration-2 @endif"
                          href="{{ route("dealer-voorraad") }}"
                          >{{ __('content/navbar.dealer-login') }}</a
                        >
                      </li>
                    </ul>
                  </div>
                </li>
              @endif
            </ul>
          </div>
        </div>
      </div>
    </nav> 
</div>