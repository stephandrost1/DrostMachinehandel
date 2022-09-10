@extends('layouts.app')
 
@section('title', 'Home')
 
@section('sidebar')
    @parent
@endsection
 
<style>
  .header {
  position: relative;
  height: 100vh;
  text-align: center;
  justify-content: center;
}

.homepage-video-style {
  position: absolute;
  width: 100%;
}

.grid-temp-cols-card {
  grid-template-columns: repeat(auto-fit, 280px);
}

@media (min-width: 768px) { 
  .grid-temp-cols-card {
    grid-template-columns: repeat(auto-fit, 330px);
  }
}
</style>

@section('content')

<div class="relative">
  <div class="absolute top-[9rem] left-1 md:top-40 lg:top-60 md:left-20 z-10">
    <div style="background-color: rgba(26, 26, 26, 0.7);" class="relative rounded-3xl relative h-screen p-7 h-min w-[350px] sm:w-[550px]">
      <h1 class="text-xl sm:text-3xl font-bold">Drost Machinehandel uw specialist in gebruikt transportmaterieel!</h1>
      <hr class="w-full h-[4px] bg-primary border-none mt-1 mb-3">
      <p class="text-base sm:text-lg w-11/12">Wij verlenen ook service aan verkochte machinies. <br> De machines worden voor de verkoop grondig nagekeken en rijklaar gemaakt! <br> Desgewenst inruil va uw gebruikte machine, maar ook transport naar de gewenste locatie.</p>
      <div class="flex gap-10 mt-3">
        <button class="w-32 border-[3px] border-primary bg-transparent text-primary font-bold px-5 sm:px-20 py-1 rounded-lg flex gap-5 items-center justify-center sm:text-xl"><span>Leasen</span> <i class="fas fa-chevron-right"></i></button>
        <button class="w-32 border-[3px] border-primary bg-primary text-white font-bold px-5 sm:px-20 py-1 rounded-lg flex gap-5 items-center justify-center sm:text-xl">Voorraad <i class="fas fa-chevron-right"></i></button>
      </div>
    </div>
  </div>
  <div class="absolute bottom-5 left-8 font-bold z-10 hidden md:block">
    <div class="flex items-center gap-4 mb-2"><i class="fas fa-envelope text-2xl"></i> <span class="text-xl">info@drostmachinehandel.com</span></div>
    <div class="flex items-center gap-4"><i class="fas fa-phone-alt text-2xl"></i> <span class="text-xl">+31 0(6) 498 275 16</span></div>
  </div>
  <div id="homepage-arrow-down" class="flex flex-col items-center justify-center cursor-pointer">
    <div class="absolute bottom-0 text-primary text-6xl animate-bounce-slow z-10"><i class="fas fa-chevron-down"></i></div>
    <div class="absolute bottom-6 text-secondary text-6xl animate-bounce-slow z-10"><i class="fas fa-chevron-down"></i></div>
  </div>
  
  <video style="z-index: -1" class="opacity-50 w-screen h-screen object-cover" autoplay muted loop playsinline>
    <source src="{{ asset('/vid/backgroundVideo.mp4') }}"  type="video/mp4">
  </video>
  
</div>
  

  <div class="w-full h-fit md:h-40 bg-primary flex items-center justify-center" id="scroll-to-here">
    <div class="flex flex-col flex-wrap items-center justify-center sm:flex-row gap-1 lg:gap-10 md:py-0 py-4">
      <div class="text-3xl font-bold hidden sm:block">Heftrucks, palletwagens, stapelaars en ander transportmaterieel!</div>
      <div class="text-2xl font-bold block sm:hidden">Bekijk ons assortiment!</div>
      <button class="w-32 border-[3px] border-primary bg-white text-primary font-bold px-20 md:px-24 py-2 rounded-lg flex gap-5 items-center justify-center text-xl md:text-2xl">Voorraad <i class="fas fa-chevron-right"></i></button>
    </div>
  </div>

  <div class="my-10 flex flex-col gap-5">
    <div class="text-center font-bold text-3xl">De meest recent toegevoegde machines</div>
    <div>
      <div class="grow grid auto-rows-auto gap-10 align-items-start justify-center mt-5 grid-temp-cols-card">

        <div class="bg-white text-black w-72 md:w-[330px] rounded-xl">
          <div>
              <img src="{{ asset('/img/test-afbeelding.jpg') }}" class="mr-3 rounded-t-xl" alt="test afbeelding" />
          </div>
          
          <div class="p-3">
              <h1 class="font-bold text-xl mb-2">RX50 15 heftruck electrische triple sidesift</h1>
              <p class="text-lg">€ 8250,-</p>
      
              <button class="drop-shadow-[1px_2px_5px_rgba(0,0,0,0.75)] w-32 mt-5 border-[3px] border-primary bg-primary text-white font-bold whitespace-nowrap px-20 py-1 rounded-lg flex gap-5 items-center justify-center text-lg"><span>Meer info</span> <i class="fas fa-chevron-right"></i></button>
          </div>
        </div>

      </div>
    </div>
  </div>


@endsection