@extends('layouts.app')
@section('content')

<hr class="w-full h-2 bg-primary border-none">

<div class="content-wrapper flex justify-center">
  <form action="{{ route("login") }}" method="POST">
      @csrf

      
      <div class="flex flex-col md:flex-row md:gap-20 md:justify-center bg-white rounded-xl mt-12 px-5 py-20 md:px-10 md:py-24">
          <div class="hidden md:flex items-center">
              <img src="{{ asset('img/login-image.png') }}" alt="IMG">
          </div>

          <div class="flex items-center flex-col relative">
              <span class="font-bold text-[#333333] text-3xl text-center w-full mb-10 md:mb-10">
                   Login
              </span>

              <div class="relative w-full mb-3 z-10">
                  <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="email" placeholder="Email">
                  <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                      <i class="fa fa-envelope text-[#666666] fa-sm"></i>
                  </span>
              </div>

              <div class="relative w-full mb-3 z-10">
                  <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="password" name="password" placeholder="Password">
                  <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                      <i class="fa fa-lock text-[#666666] fa-sm"></i>
                  </span>
              </div>

              @if (Session::has('errors'))
                  <div class="text-red-500 rounded">
                      <ul class="text-center">
                          @foreach (Session::get('errors')->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              
              <div class="w-full flex justify-center mt-1 md:mt-5">
                  <button type="submit" class="w-full h-5 rounded-2xl bg-primary flex justify-center items-center px-0 py-6 font-bold">
                      Inloggen
                  </button>
              </div>

              <div class="text-center mt-2 font-bold">
                  <a class="text-[#666666]" href="#">
                      Gebruikersnaam / Wachtwoord
                  </a>
                  <span class="text-[#999999]">
                      vergeten?
                  </span>
                  
              </div>
          </div>
      </div>
  </form>
</div>

@endsection