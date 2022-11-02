@extends('layouts.app')
@section('content')

<hr class="w-full h-2 bg-primary border-none">

<div class="px-5 md:px-20 py-7">
  
  <div class="mb-5">
    <h1 class="font-bold text-3xl">{{ __('content/lease.lease') }}</h1>
  </div>
  


  <div class="flex flex-wrap gap-10">
    <div style="flex: 1 0 21%;" class="h-fit grow-0 border-primary border-[3px] rounded-xl p-5 min-w-full sm:min-w-[440px] order-2 lg:order-1">
        <div>
            <h1 class="text-2xl font-bold mb-2">{{ __('content/lease.lease') }}</h1>
            <p>{{ __('content/lease.arrange-financing') }}</p>
        </div>

        <form class="mt-4" action="">
            
            <div class="flex flex-col gap-5">
                <div>
                    <label for="aanschafwaarde" class="block mb-2 text-white font-[800]">{{ __('content/lease.purchase-value') }}</label>
                    <div class="flex w-5/12 sm:w-3/12">
                        <span class="inline-flex items-center px-3 text-white font-bold bg-transparent rounded-l-md border-2 border-r-0 border-secondary">
                            <i class="fas fa-euro-sign fa-xs"></i>
                        </span>
                        <input type="text" id="aanschafwaarde" class="rounded-none rounded-r-lg bg-transparent border-2 text-lg placeholder:italic text-white block flex-1 min-w-0 w-full border-secondary p-1 placeholder:text-secondary focus:border-secondary focus:ring-0" placeholder="0">
                    </div>
                </div>
    
                <div>
                    <label for="aanschafwaarde" class="block mb-2 text-white font-[800]">{{ __('content/lease.duration') }} <span class="font-normal text-secondary">{{ __('content/lease.months-amount') }}</span></label>
                    <div class="flex w-5/12 sm:w-3/12">
                        <input type="text" id="aanschafwaarde" class="rounded-none rounded-l-md rounded-r-lg bg-transparent border-2 text-lg placeholder:italic text-white block flex-1 min-w-0 w-full border-secondary p-1 placeholder:text-secondary focus:border-secondary focus:ring-0" placeholder="In maanden">
                    </div>
                </div>
    
                <div>
                    <label for="aanschafwaarde" class="block mb-2 text-white font-[800]">{{ __('content/lease.deposit') }} <span class="font-normal text-secondary">{{ __('content/lease.money-amount') }}</span></label>
                    <div class="flex w-5/12 sm:w-3/12">
                        <span class="inline-flex items-center px-3 text-white font-bold bg-transparent rounded-l-md border-2 border-r-0 border-secondary">
                            <i class="fas fa-euro-sign fa-xs"></i>
                        </span>
                        <input type="text" id="aanschafwaarde" class="rounded-none rounded-r-lg bg-transparent border-2 text-lg placeholder:italic text-white block flex-1 min-w-0 w-full border-secondary p-1 placeholder:text-secondary focus:border-secondary focus:ring-0" placeholder="0">
                    </div>
                </div>
            </div>

            <button type="submit" class="mt-5 w-32 border-[3px] border-primary bg-primary text-white font-bold px-24 py-1 rounded-lg flex gap-5 items-center justify-center">{{ __('content/lease.calculate') }} <i class="fas fa-calculator"></i></button>

        </form>
    </div>
    <div style="flex: 1 0 21%;" class="grow-0 border-primary border-[3px] rounded-xl p-5 h-fit min-w-full sm:min-w-[440px] order-1 lg:order-2">
      
        <div>
            <h1 class="text-2xl font-bold mb-3">{{ __('content/lease.lease') }}</h1>
            <p>{{ __('content/lease.information-leasing') }}</p>
        </div>

    </div>
  </div>

  
</div>

@endsection