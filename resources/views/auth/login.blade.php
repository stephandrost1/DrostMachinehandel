@extends('layouts.app')
@section('content')

<hr class="w-full h-2 bg-primary border-none">

<div class="content-wrapper flex justify-center">
  <form action="{{ route("login") }}" method="POST">
      @csrf
    <input type="hidden" name="from_login_form" value="{{ $login ?? '1' }}">  
      <div class="flex flex-col md:flex-row md:gap-20 md:justify-center bg-white rounded-xl mx-5 sm:mx-0 mt-12 px-5 py-20 md:px-10 md:py-24">
          <div class="hidden md:flex items-center">
              <img src="{{ asset('img/login-image.png') }}" alt="IMG">
          </div>

          <div class="flex items-center flex-col relative">
              <span class="font-bold text-[#333333] text-3xl text-center w-full mb-10 md:mb-10 flex flex-col gap-1">
                   <span>
                        {{ __('content/login.logon') }}
                    </span>
                   <span class="text-[#999999] text-base">
                        {{ __('content/login.subtext') }}
                  </span>
              </span>
              

              <div class="relative w-full mb-3 z-10">
                  <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="email" placeholder="{{ __('content/login.email') }}">
                  <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                      <i class="fa fa-envelope text-[#666666] fa-sm"></i>
                  </span>
              </div>

              <div class="relative w-full mb-3 z-10">
                  <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="password" name="password" placeholder="{{ __('content/login.password') }}">
                  <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                      <i class="fa fa-lock text-[#666666] fa-sm"></i>
                  </span>
              </div>

            @if(session()->has('success'))
                <div class="text-green-500 rounded">
                      <ul class="text-center">
                            <p class="max-w-[250px]">{{ session()->get('success') }}</p>
                      </ul>
                  </div>
            @endif
              @if (Session::has('errors'))
                  <div class="text-red-500 rounded">
                      <ul class="text-center">
                          @foreach (Session::get('errors')->all() as $error)
                              <li class="max-w-[250px]">{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              
              <div class="w-full flex justify-center mt-1 md:mt-5">
                  <button type="submit" class="w-full h-5 rounded-2xl bg-primary flex justify-center items-center px-0 py-6 font-bold">
                    {{ __('content/login.login') }}
                  </button>
              </div>

                @if (App::getLocale() == 'en')
                    <div class="text-center mt-2 font-bold">
                        <span class="text-[#999999]">
                            {{ __('content/login.forgot') }}
                        </span>
                        <a class="text-[#666666] underline underline-offset-2" href="#">
                            {{ __('content/login.email/password') }}?
                        </a>
                    </div>
                @else 
                    <div class="text-center mt-2 font-bold">
                        <a class="text-[#666666] underline underline-offset-2" href="#">
                        {{ __('content/login.email/password') }}
                        </a>
                        <span class="text-[#999999]">
                        {{ __('content/login.forgot') }}?
                        </span>
                    </div>
                @endif

                <div class="text-center mt-10 font-bold">
                    <a class="text-[#666666] flex items-center" href="{{ route('dealer-create') }}">
                        <span>{{ __('content/login.create-account') }}</span>
                        <i class="fas fa-long-arrow-alt-right ml-2"></i>
                    </a>
                </div>
          </div>
      </div>
  </form>
</div>

@endsection