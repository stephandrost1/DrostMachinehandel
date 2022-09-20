@extends('layouts.app')
@section('content')

<hr class="w-full h-3 bg-primary border-none">

<div class="px-5 md:px-20 py-7">
  
  <div class="mb-5">
    <h1 class="font-bold text-3xl">De totale voorraad</h1>
  </div>

  <div class="flex gap-5">
    {{-- <div>
      <h1 class="text-2xl font-bold mb-2"><i class="fas fa-sliders-h"></i> Filters</h1>

      <button class="w-32 border-[3px] border-primary bg-transparent text-primary font-bold px-16 py-1 rounded-lg flex gap-5 items-center justify-center"><span>Toepassen</span> <i class="fas fa-chevron-right"></i></button>
    </div>

    <div class="grow grid auto-rows-auto gap-10 align-items-start justify-start mt-5" style="grid-template-columns: repeat(auto-fit, 280px);"> 
        <div class="bg-white text-black w-72 rounded-xl">
            <div>
                <img src="{{ asset('/img/test-afbeelding.jpg') }}" class="mr-3 rounded-t-xl" alt="test afbeelding" />
            </div>
            
            <div class="p-3">
                <h1 class="font-bold text-lg mb-2">RX50 15 heftruck electrische triple sidesift</h1>
                <p>€ 8250,-</p>
        
                <button class="mt-4 border-[3px] border-primary bg-primary text-white font-bold px-5 py-1 rounded-lg flex gap-5 items-center justify-center">Meer info <i class="fas fa-chevron-right"></i></button>
            </div>
          </div>
    
          <div class="bg-white text-black w-72 rounded-xl">
            <div>
                <img src="{{ asset('/img/test-afbeelding.jpg') }}" class="mr-3 rounded-t-xl" alt="test afbeelding" />
            </div>
            
            <div class="p-3">
                <h1 class="font-bold text-lg mb-2">RX50 15 heftruck electrische triple sidesift</h1>
                <p>€ 8250,-</p>
        
                <button class="mt-4 border-[3px] border-primary bg-primary text-white font-bold px-5 py-1 rounded-lg flex gap-5 items-center justify-center">Meer info <i class="fas fa-chevron-right"></i></button>
            </div>
          </div>

          <div class="bg-white text-black w-72 rounded-xl">
            <div>
                <img src="{{ asset('/img/test-afbeelding.jpg') }}" class="mr-3 rounded-t-xl" alt="test afbeelding" />
            </div>
            
            <div class="p-3">
                <h1 class="font-bold text-lg mb-2">RX50 15 heftruck electrische triple sidesift</h1>
                <p>€ 8250,-</p>
        
                <button class="mt-4 border-[3px] border-primary bg-primary text-white font-bold px-5 py-1 rounded-lg flex gap-5 items-center justify-center">Meer info <i class="fas fa-chevron-right"></i></button>
            </div>
          </div>
    
          <div class="bg-white text-black w-72 rounded-xl">
            <div>
                <img src="{{ asset('/img/test-afbeelding.jpg') }}" class="mr-3 rounded-t-xl" alt="test afbeelding" />
            </div>
            
            <div class="p-3">
                <h1 class="font-bold text-lg mb-2">RX50 15 heftruck electrische triple sidesift</h1>
                <p>€ 8250,-</p>
        
                <button class="mt-4 border-[3px] border-primary bg-primary text-white font-bold px-5 py-1 rounded-lg flex gap-5 items-center justify-center">Meer info <i class="fas fa-chevron-right"></i></button>
            </div>
          </div>

          <div class="bg-white text-black w-72 rounded-xl">
            <div>
                <img src="{{ asset('/img/test-afbeelding.jpg') }}" class="mr-3 rounded-t-xl" alt="test afbeelding" />
            </div>
            
            <div class="p-3">
                <h1 class="font-bold text-lg mb-2">RX50 15 heftruck electrische triple sidesift</h1>
                <p>€ 8250,-</p>
        
                <button class="mt-4 border-[3px] border-primary bg-primary text-white font-bold px-5 py-1 rounded-lg flex gap-5 items-center justify-center">Meer info <i class="fas fa-chevron-right"></i></button>
            </div>
          </div>
    
          <div class="bg-white text-black w-72 rounded-xl">
            <div>
                <img src="{{ asset('/img/test-afbeelding.jpg') }}" class="mr-3 rounded-t-xl" alt="test afbeelding" />
            </div>
            
            <div class="p-3">
                <h1 class="font-bold text-lg mb-2">RX50 15 heftruck electrische triple sidesift</h1>
                <p>€ 8250,-</p>
        
                <button class="mt-4 border-[3px] border-primary bg-primary text-white font-bold px-5 py-1 rounded-lg flex gap-5 items-center justify-center">Meer info <i class="fas fa-chevron-right"></i></button>
            </div>
          </div>

          <div class="bg-white text-black w-72 rounded-xl">
            <div>
                <img src="{{ asset('/img/test-afbeelding.jpg') }}" class="mr-3 rounded-t-xl" alt="test afbeelding" />
            </div>
            
            <div class="p-3">
                <h1 class="font-bold text-lg mb-2">RX50 15 heftruck electrische triple sidesift</h1>
                <p>€ 8250,-</p>
        
                <button class="mt-4 border-[3px] border-primary bg-primary text-white font-bold px-5 py-1 rounded-lg flex gap-5 items-center justify-center">Meer info <i class="fas fa-chevron-right"></i></button>
            </div>
          </div>
    
          <div class="bg-white text-black w-72 rounded-xl">
            <div>
                <img src="{{ asset('/img/test-afbeelding.jpg') }}" class="mr-3 rounded-t-xl" alt="test afbeelding" />
            </div>
            
            <div class="p-3">
                <h1 class="font-bold text-lg mb-2">RX50 15 heftruck electrische triple sidesift</h1>
                <p>€ 8250,-</p>
        
                <button class="mt-4 border-[3px] border-primary bg-primary text-white font-bold px-5 py-1 rounded-lg flex gap-5 items-center justify-center">Meer info <i class="fas fa-chevron-right"></i></button>
            </div>
          </div>
    
          <div class="bg-white text-black w-72 rounded-xl">
            <div>
                <img src="{{ asset('/img/test-afbeelding.jpg') }}" class="mr-3 rounded-t-xl" alt="test afbeelding" />
            </div>
            
            <div class="p-3">
                <h1 class="font-bold text-lg mb-2">RX50 15 heftruck electrische triple sidesift</h1>
                <p>€ 8250,-</p>
        
                <button class="mt-4 border-[3px] border-primary bg-primary text-white font-bold px-5 py-1 rounded-lg flex gap-5 items-center justify-center">Meer info <i class="fas fa-chevron-right"></i></button>
            </div>
          </div>
    
      </div> --}}
      <div class="stock text-white" id="stock-items"></div>
      <div id="svm-canvas"></div>
    </div>

</div>

@endsection