@extends('layouts.app')
@section('content')

<hr class="w-full h-2 bg-primary border-none">

<div class="verhuur-wrapper px-5 md:px-20 py-7">
  <div class="flex gap-5">
    @foreach($machines as $machineKey => $machineValue)
        <div class="bg-white m-8 ">
            <span class="text-black">{{ $machineValue["vehicle_name"] }}</span><br>
            <span class="text-black">{{ $machineValue["vehicle_description"] }}</span><br>
            <span class="text-black">{{ $machineValue["price_per_day"] }}</span><br>
            <span class="text-black">{{ $machineValue["price_per_week"] }}</span>
        </div>
    @endforeach
      
    </div>
</div>


@endsection