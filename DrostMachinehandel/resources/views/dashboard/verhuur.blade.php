@extends('layouts/dashboard.dashboard')
@section('content')

<section class="w-full">
    <div id="main" class="main-content w-full h-full flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
        {{-- Page header --}}
        <div class="bg-gray-800 pt-3">
            <div class="rounded-tl-3xl bg-gradient-to-r from-primary to-gray-800 p-4 shadow text-2xl text-white">
                <h1 class="font-bold pl-2">Machines verhuur</h1>
            </div>
        </div>

             <div class="flex flex-wrap">
                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <!--Metric Card-->
                        <div class="bg-gradient-to-b from-primary flex items-start justify-between to-primary-200 border-b-4 border-primary rounded-lg shadow-xl p-5">
                            <div id="select-rent-vehicle-wrapper" class="flex flex-col rounded-lg shadow-xl w-3/4 pr-0 px-5 border-2 border-green-500 bg-green-200">
                                <div id="select-rent-vehicle-toggler" class="selected-vehicle mr-4 truncate overflow-hidden my-2">
                                    <span id="selected-vehicle" class=" text-green-500 font-bold">Nog geen machine geselecteerd</span>
                                </div>
                                <div id="select-rent-vehicle-dropdown" class="possible-options max-h-56 duration-300 overflow-scroll pr-4">
                                    @foreach($machines as $key => $vehicle)
                                        <div class="option border-b-2 border-green-500 w-full hover:font-bold hover:cursor-pointer @if($key != 0) mt-3 @endif">
                                            <span class="select-rent-vehicle-option text-green-500" id="{{ $vehicle->id }}">{{ $vehicle->vehicle_name }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div id="select-rent-vehicle-button" class="flex rounded-lg shadow-xl py-2 px-5 border-2 border-green-500 bg-green-200">
                                <button class="text-green-500 font-bold">Selecteer</button>
                            </div>
                        </div>
                        <!--/Metric Card-->
                    </div>
                      <div class="w-full md:w-1/2 xl:w-2/3 p-6">
                        <div class="bg-gradient-to-b from-primary flex items-start justify-between to-primary-200 border-b-4 border-primary rounded-lg shadow-xl p-5">
                            <div id="selected-vehicle-data"></div>
                        </div>
                    </div>
                </div>
    </div>
</section>

@endsection