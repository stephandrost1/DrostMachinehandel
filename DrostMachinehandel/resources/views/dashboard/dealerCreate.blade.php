@extends('layouts.app')
@section('content')

<hr class="w-full h-2 bg-primary border-none">

<div class="content-wrapper flex justify-center">
    <form action="{{ route("dealer-create-request") }}" method="POST">
        @csrf
        
        <div class="flex flex-col max-w-[700px] md:flex-row md:gap-20 md:justify-center bg-white rounded-xl mt-8 mb-5 mx-8 px-5 py-20 md:px-10 md:py-14">
            <div class="flex items-center flex-col relative">
                <span class="font-bold text-[#333333] text-3xl text-center w-full mb-10 md:mb-10">
                    {{ __('content/signup.title') }}
                </span>

                <div class="flex flex-col gap-3">
                    <div class="flex flex-col sm:flex-row gap-3">
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="firstname" placeholder="{{ __('content/signup.firstname') }}">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-user-tag text-[#666666] fa-sm"></i>
                            </span>
                        </div>
        
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="lastname" placeholder="{{ __('content/signup.lastname') }}">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-user-tag text-[#666666] fa-sm"></i>
                            </span>
                        </div>
                    </div>
    
                    <div class="flex flex-col sm:flex-row gap-3">
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="email" placeholder="{{ __('content/signup.e-mail') }}">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fa fa-envelope text-[#666666] fa-sm"></i>
                            </span>
                        </div>
        
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="phonenumber" placeholder="{{ __('content/signup.phone') }}">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fa fa-phone-alt text-[#666666] fa-sm"></i>
                            </span>
                        </div>
                    </div>
    
                    <div class="flex flex-col sm:flex-row gap-3">
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="country" placeholder="{{ __('content/signup.country') }}">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-globe-europe text-[#666666] fa-sm"></i>
                            </span>
                        </div>
        
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="province" placeholder="{{ __('content/signup.province') }}">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-globe-europe text-[#666666] fa-sm"></i>
                            </span>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="city" placeholder="{{ __('content/signup.city') }}">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-map-marker-alt text-[#666666] fa-sm"></i>
                            </span>
                        </div>
        
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="postalcode" placeholder="{{ __('content/signup.postalcode') }}">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-map-marker-alt text-[#666666] fa-sm"></i>
                            </span>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="streetname" placeholder="{{ __('content/signup.streetname') }}">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-home text-[#666666] fa-sm"></i>
                            </span>
                        </div>
        
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="housenumber" placeholder="{{ __('content/signup.housenumber') }}">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-home text-[#666666] fa-sm"></i>
                            </span>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="company" placeholder="{{ __('content/signup.company') }}">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-building text-[#666666] fa-sm"></i>
                            </span>
                        </div>
        
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="kvknumber" placeholder="{{ __('content/signup.kvknumber') }}">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-coins text-[#666666] fa-sm"></i>
                            </span>
                        </div>
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="btwnumber" placeholder="{{ __('content/signup.btwnumber') }}">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-coins text-[#666666] fa-sm"></i>
                            </span>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center gap-3">
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="password" name="password" placeholder="{{ __('content/signup.password') }}">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-lock text-[#666666] fa-sm"></i>
                            </span>
                        </div>
        
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="password" name="password-repeat" placeholder="{{ __('content/signup.repeat-password') }}">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-lock text-[#666666] fa-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>

                @if (Session::has('errors'))
                    <div class="text-red-500 rounded mt-3">
                        <ul>
                            @foreach (Session::get('errors')->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="w-full sm:w-1/2 flex justify-center mt-2 md:mt-5">
                    <button type="submit" class="w-full h-5 rounded-2xl bg-primary flex justify-center items-center px-0 py-6 font-bold">
                        {{ __('content/signup.create-account') }}
                    </button>
                </div>

                <div class="text-center mt-5 font-bold">
                    <span class="text-[#999999]">
                        {{ __('content/signup.do-you-already-have-an') }}
                    </span>
                    <a class="text-[#666666]" href="{{ route('login') }}">
                        {{ __('content/signup.account') }}?
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection