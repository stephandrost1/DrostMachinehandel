@extends('layouts.app')
@section('content')

<hr class="w-full h-2 bg-primary border-none">

<div class="content-wrapper flex justify-center">
    <form action="{{ route("dealer-create-request") }}" method="POST">
        @csrf
        
        <div class="flex flex-col max-w-[700px] md:flex-row md:gap-20 md:justify-center bg-white rounded-xl mt-12 px-5 py-20 md:px-10 md:py-14">
            {{-- <div class="hidden md:flex items-center">
                <img src="{{ asset('img/login-image.png') }}" alt="IMG">
            </div> --}}

            <div class="flex items-center flex-col relative">
                <span class="font-bold text-[#333333] text-3xl text-center w-full mb-10 md:mb-10">
                    Dealer account aanmaken
                </span>

                <div class="flex flex-col gap-3">
                    <div class="flex items-center gap-3">
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="firstname" placeholder="Voornaam">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-user-tag text-[#666666] fa-sm"></i>
                            </span>
                        </div>
        
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="lastname" placeholder="Achternaam">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-user-tag text-[#666666] fa-sm"></i>
                            </span>
                        </div>
                    </div>
    
                    <div class="flex items-center gap-3">
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="email" placeholder="E-mailadres">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fa fa-envelope text-[#666666] fa-sm"></i>
                            </span>
                        </div>
        
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="phonenumber" placeholder="Telefoonnummer">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fa fa-phone-alt text-[#666666] fa-sm"></i>
                            </span>
                        </div>
                    </div>
    
                    <div class="flex items-center gap-3">
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="country" placeholder="Land">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-globe-europe text-[#666666] fa-sm"></i>
                            </span>
                        </div>
        
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="province" placeholder="Provincie">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-globe-europe text-[#666666] fa-sm"></i>
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="city" placeholder="Plaats">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-map-marker-alt text-[#666666] fa-sm"></i>
                            </span>
                        </div>
        
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="postalcode" placeholder="Postcode">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-map-marker-alt text-[#666666] fa-sm"></i>
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="streetname" placeholder="Straatnaam">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-home text-[#666666] fa-sm"></i>
                            </span>
                        </div>
        
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="housenumber" placeholder="Huisnummer">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-home text-[#666666] fa-sm"></i>
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="company" placeholder="Bedrijfsnaam">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-building text-[#666666] fa-sm"></i>
                            </span>
                        </div>
        
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="kvknumber" placeholder="KVK nummer">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-coins text-[#666666] fa-sm"></i>
                            </span>
                        </div>
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="text" name="btwnumber" placeholder="BTW nummer">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-coins text-[#666666] fa-sm"></i>
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="password" name="password" placeholder="Wachtwoord">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-lock text-[#666666] fa-sm"></i>
                            </span>
                        </div>
        
                        <div class="relative w-full z-10">
                            <input class="placeholder:text-[#999999] focus:ring-primary border-none font-bold text-[#666666] block w-full bg-[#e6e6e6] h-12 rounded-2xl px-10 py-5 relative" type="password" name="password-repeat" placeholder="Wachtwoord herhalen">
                            <span class="flex items-center absolute rounded-xl bottom-0 left-0 h-full pl-5">
                                <i class="fas fa-lock text-[#666666] fa-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>

                @if (Session::has('errors'))
                    <div class="text-red-500 rounded">
                        <ul>
                            @foreach (Session::get('errors')->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="w-1/2 flex justify-center mt-1 md:mt-5">
                    <button type="submit" class="w-full h-5 rounded-2xl bg-primary flex justify-center items-center px-0 py-6 font-bold">
                        Account aanmaken
                    </button>
                </div>

                <div class="text-center mt-5 font-bold">
                    <span class="text-[#999999]">
                        Heb je al een
                    </span>
                    <a class="text-[#666666]" href="{{ route('dealer-login') }}">
                        account?
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection