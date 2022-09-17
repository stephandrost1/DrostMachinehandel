@extends('layouts.app')
@section('content')

<hr class="w-full h-3 bg-primary border-none">

<div class="px-5 md:px-20 py-7">
  
  <div class="mb-5">
    <h1 class="font-bold text-3xl">Leasen</h1>
  </div>
  


  <div class="flex flex-wrap gap-10">
    <div style="flex: 1 0 21%;" class="h-fit grow-0 border-primary border-[3px] rounded-xl p-5 min-w-full sm:min-w-[440px] order-2 lg:order-1">
        <div>
            <h1 class="text-2xl font-bold mb-2">Calculator</h1>
            <p>Voordelige financiering regelen? Bereken hieronder gemakkelijk je 
            maandlasten en regel direct je persoonlijk financieringsplan.</p>
        </div>

        <form class="mt-4" action="">
            
            <div class="flex flex-col gap-5">
                <div>
                    <label for="aanschafwaarde" class="block mb-2 font-medium text-white font-[800]">Aanschafwaarde</label>
                    <div class="flex w-5/12 sm:w-3/12">
                        <span class="inline-flex items-center px-3 text-white font-bold bg-transparent rounded-l-md border-2 border-r-0 border-secondary">
                            <i class="fas fa-euro-sign fa-xs"></i>
                        </span>
                        <input type="text" id="aanschafwaarde" class="rounded-none rounded-r-lg bg-transparent border-2 text-lg placeholder:italic text-white block flex-1 min-w-0 w-full border-secondary p-1 placeholder:text-secondary focus:border-secondary focus:ring-0" placeholder="0">
                    </div>
                </div>
    
                <div>
                    <label for="aanschafwaarde" class="block mb-2 font-medium text-white font-[800]">Looptijd <span class="font-normal text-secondary">(tussen 36 en 84 maanden)</span></label>
                    <div class="flex w-5/12 sm:w-3/12">
                        <input type="text" id="aanschafwaarde" class="rounded-none rounded-l-md rounded-r-lg bg-transparent border-2 text-lg placeholder:italic text-white block flex-1 min-w-0 w-full border-secondary p-1 placeholder:text-secondary focus:border-secondary focus:ring-0" placeholder="In maanden">
                    </div>
                </div>
    
                <div>
                    <label for="aanschafwaarde" class="block mb-2 font-medium text-white font-[800]">Aanbetaling <span class="font-normal text-secondary">(tussen €3.000 en €29.999)</span></label>
                    <div class="flex w-5/12 sm:w-3/12">
                        <span class="inline-flex items-center px-3 text-white font-bold bg-transparent rounded-l-md border-2 border-r-0 border-secondary">
                            <i class="fas fa-euro-sign fa-xs"></i>
                        </span>
                        <input type="text" id="aanschafwaarde" class="rounded-none rounded-r-lg bg-transparent border-2 text-lg placeholder:italic text-white block flex-1 min-w-0 w-full border-secondary p-1 placeholder:text-secondary focus:border-secondary focus:ring-0" placeholder="0">
                    </div>
                </div>
            </div>

            <button type="submit" class="mt-5 w-32 border-[3px] border-primary bg-primary text-white font-bold px-24 py-1 rounded-lg flex gap-5 items-center justify-center">Berekenen <i class="fas fa-calculator"></i></button>

        </form>
    </div>
    <div style="flex: 1 0 21%;" class="grow-0 border-primary border-[3px] rounded-xl p-5 h-fit min-w-full sm:min-w-[440px] order-1 lg:order-2">
      
        <div>
            <h1 class="text-2xl font-bold mb-3">Leasen</h1>
            <p>Hier komt informatie over leasen...</p>
        </div>

    </div>
  </div>

  
</div>

@endsection