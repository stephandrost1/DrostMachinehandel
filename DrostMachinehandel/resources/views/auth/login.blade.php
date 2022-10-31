@extends('layouts.app')
@section('content')

<hr class="w-full h-2 bg-primary border-none">

<div class="mt-12 flex flex-col items-center justify-center">
  
  <div class="login-title-wrapper bg-primary">
    <h1 class="font-bold text-3xl text-center login-title">{{ __('content/login.login') }}</h1>
  </div>
  <form method="POST" action="{{ route('login') }}" class="bg-gray-800 login-form">
      @csrf
      <div class="mb-3 mt-5">
        <div class="mb-2">
            <label for="email" class="font-bold text-primary pb-1">{{ __('content/login.email') }}</label> </br>
            <input required type="text" id="email" name="email" placeholder="JohnDoe@example.com" class="border-2 border-secondary rounded-md w-full text-gray-700 focus:border-secondary focus:ring-0">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="mb-2">
            <label for="email" class="font-bold text-primary pb-1">{{ __('content/login.password') }}</label> </br>
            <div>
              <input required id="password" name="password" type="password"  placeholder="&bull;&bull;&bull;&bull;&bull;&bull;" class="border-2 border-secondary rounded-md w-full text-gray-700 focus:border-secondary focus:ring-0">
              <i id="passwordIcon" class="fas fa-eye password-icon" onclick="togglePasswordVisibility()"></i>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
      </div>

      <div class="mb-3 flex items-center gap-1">
        <input id="remember_me" name="remember" type="checkbox" class="focus:border-transparent focus:ring-0 login-remind-me"> {{ __('content/login.remember_me') }} </br>
      </div>
    
      <div>
        <button type="submit" class="bg-primary rounded-md w-full font-bold text-white login-button">{{ __('content/login.login') }}</button>
      </div>
  </form>

  <script>
    function togglePasswordVisibility() {
      var input = document.getElementById("password");
      var icon = document.getElementById("passwordIcon")
      if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      }
    }
    </script>
  
</div>

@endsection