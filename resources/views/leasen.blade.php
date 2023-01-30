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
        <div id="lease-app"></div>
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