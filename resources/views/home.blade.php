@extends('layouts.app')
@section('content')

<div class="relative">
  <div class="content-block-homepage absolute z-10">
    <div style="background-color: rgba(26, 26, 26, 0.7);" class="relative rounded-3xl content-block-homepage-inner p-7">
      <h1 class="text-xl sm:text-3xl font-bold">{{ __('content/homepage.title') }}</h1>
      <hr class="w-full h-[4px] bg-primary border-none mt-1 mb-3">
      <p class="content-block-subtitle text-base sm:text-lg w-11/12">{{ __('content/homepage.subtitle') }}</p>
      <div class="flex gap-5 content-buttons-wrapper mt-3">
        <a href={{ route("leasen") }}>
          <button class="cta-button w-32 border-[3px] border-primary bg-transparent text-primary font-bold px-5 sm:px-20 py-1 rounded-lg flex gap-5 items-center justify-center sm:text-xl"><span>{{ __('content/homepage.lease') }}</span> <i class="fas fa-chevron-right"></i></button>
        </a>
        
        <a href={{ route("voorraad") }}>
          <button class="cta-button w-32 border-[3px] border-primary bg-primary text-white font-bold px-5 sm:px-20 py-1 rounded-lg flex gap-5 items-center justify-center sm:text-xl">{{ __('content/homepage.stock') }}<i class="fas fa-chevron-right"></i></button>
        </a>
      </div>
    </div>
  </div>
  <div class="absolute bottom-5 left-8 font-bold z-10 hidden md:block content-contact-wrapper">
    <div class="flex items-center gap-4 mb-2"><i class="fas fa-envelope text-2xl"></i> <span class="text-xl">info@drostmachinehandel.com</span></div>
    <div class="flex items-center gap-4"><i class="fas fa-phone-alt text-2xl"></i> <span class="text-xl">+31 0(6) 498 275 16</span></div>
  </div>
  <div id="homepage-arrow-down" class="flex flex-col items-center justify-center cursor-pointer">
    <div class="absolute bottom-0 text-primary text-6xl animate-bounce-slow z-10"><i class="fas fa-chevron-down"></i></div>
    <div class="absolute bottom-6 text-secondary text-6xl animate-bounce-slow z-10"><i class="fas fa-chevron-down"></i></div>
  </div>
  
  <video style="z-index: -1" class="opacity-50 w-screen h-screen object-cover" autoplay muted loop playsinline>
    <source src="{{ asset('/vid/backgroundVideo.mp4') }}#t=0.5" preload="metadata"  type="video/mp4">
  </video>
  
</div>
  

  <div id="check-our-vehicles" class="w-full h-fit md:h-40 bg-primary flex items-center justify-center" id="scroll-to-here">
    <div class="flex flex-col items-center justify-center gap-1 md:py-0 py-3">
      <div class="text-xl md:text-2xl lg:text-3xl  font-bold block text-center">{{ __('content/homepage.quote') }}</div>
      <a href={{ route("voorraad") }}>
        <button class="w-fit border-[3px] border-primary bg-white text-primary font-bold px-12 md:px-16 py-2 rounded-lg flex gap-5 items-center justify-center mt-3 text-lg md:text-xl lg:text-2xl">{{ __('content/homepage.quote-link') }}<i class="fas fa-chevron-right"></i></button>
      </a>
    </div>
  </div>

  <div class="my-10 recent-items flex flex-col gap-5">
    <div class="text-center font-bold text-3xl px-2">{{ __('content/homepage.recently-added-title') }}</div>
    <div id="recently-added-machines" class="swiper swiper-recent-items w-full">
      <div class="swiper-wrapper" id="recently-added-items">
      </div>
    </div>
    <div id="svm-canvas" class="svm-canvas-hidden"></div>
  </div>


@endsection