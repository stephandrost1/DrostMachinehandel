@extends('layouts.app')
@section('content')

<hr class="w-full h-2 bg-primary border-none">

<div class="content-wrapper px-5 py-7">
  
  <div class="mb-5">
    <h1 class="font-bold text-3xl">{{ __('content/lease.calculator') }}</h1>
  </div>

  <div class="flex gap-10 calculator-wrapper">
    <div class="item h-fit w-7/12 grow-0 border-primary border-[3px] rounded-xl p-5 pb-8 min-w-full sm:min-w-[440px]">
        <div id="lease-app"></div>
    </div>
    <div class="item grow-0 w-5/12 border-primary border-[3px] rounded-xl p-5 h-fit min-w-full sm:min-w-[440px]">
      
        <div>
            <h1 class="text-2xl font-bold mb-3">{{ __('content/lease.lease') }}</h1>
            <p>{{ __('content/lease.information-leasing') }}</p>
        </div>

    </div>
  </div>

  
</div>

@endsection