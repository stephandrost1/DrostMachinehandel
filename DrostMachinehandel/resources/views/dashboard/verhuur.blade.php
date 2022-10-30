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
                    <div class="w-full md:w-1/4 h-full p-6 flex">
                        <!--Metric Card-->
                        <div class="bg-gradient-to-b w-full from-primary flex items-start justify-between to-primary-200 border-b-4 border-primary rounded-lg shadow-xl p-5">
                            <div id="select-rent-vehicle-wrapper" class="flex flex-col rounded-lg shadow-xl w-3/4 pr-0 px-5 border-2 border-green-500 bg-green-200">
                                <div id="select-rent-vehicle-toggler" class="selected-vehicle mr-4 truncate overflow-hidden my-2">
                                    <span id="selected-vehicle" class=" text-green-500 font-bold">Nog geen machine geselecteerd</span>
                                </div>
                                <div id="select-rent-vehicle-dropdown" class="possible-options duration-300 pr-4">
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
                      <div class="w-full md:w-3/4 p-6">
                        <div class="header mb-5 w-full flex items-center gap-5 justify-end">
                            <div class="bg-gradient-to-b w-1/8 from-green-500 flex items-start justify-between to-green-200 border-b-4 border-green-500 rounded-lg shadow-xl p-3">
                                <div id="select-rent-vehicle-button" class="flex rounded-lg shadow-xl py-2 px-5 border-2 border-green-500 bg-green-200">
                                    <button class="text-green-500 font-bold">Toevoegen</button>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-b from-primary flex items-start justify-between to-primary-200 border-b-4 border-primary rounded-lg shadow-xl p-5">
                            <div id="selected-vehicle-data" class="flex gap-5 hidden">
                                <div class="flex gap-5">
                                    <div class="col-left flex flex-col gap-5 w-1/2">
                                        <div class="row-1 h-4/5">
                                            <img src="https://picsum.photos/1200" class="rounded-lg w-full h-full object-cover" />
                                        </div>
                                        <div class="row-2 flex gap-5 h-1/5">
                                            <div class="image w-1/4">
                                                <img src="https://picsum.photos/400" class="rounded-lg w-full h-full object-cover" />
                                            </div>
                                            <div class="image w-1/4">
                                                <img src="https://picsum.photos/400" class="rounded-lg w-full h-full object-cover" />
                                            </div>
                                            <div class="image w-1/4">
                                                <img src="https://picsum.photos/400" class="rounded-lg w-full h-full object-cover" />
                                            </div>
                                            <div class="image w-1/4">
                                                <img src="https://picsum.photos/400" class="rounded-lg w-full h-full object-cover" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-right w-1/2 ">
                                        <div class="content flex flex-col mb-5 gap-5 w-full">
                                            <div id="selected-vehicle" class="row flex justify-between gap-5">
                                                <span class="w-1/2">Naam:</span>
                                                <input placeholder="Machine 1" name="vehicleName" id="selected-vehicle-name" class="w-1/2 h-12 rounded-lg border-2 border-primary pl-2" />
                                            </div>
                                            <div class="row flex justify-between gap-5">
                                                <span class="w-1/2">Beschrijving:</span>
                                                <textarea placeholder="Machine 1" name="vehicleName" id="selected-vehicle-description" rows="4" class="w-1/2 rounded-lg border-2 border-primary pl-2"></textarea>
                                            </div>
                                            <div class="row flex justify-between gap-5">
                                                <span class="w-1/2">Prijs per dag:</span>
                                                <input placeholder="Machine 1" name="vehicleName" id="selected-vehicle-price-per-day" class="w-1/2 h-12 rounded-lg border-2 border-primary pl-2" />
                                            </div>
                                            <div class="row flex justify-between gap-5">
                                                <span class="w-1/2">Prijs per week:</span>
                                                <input placeholder="Machine 1" name="vehicleName" id="selected-vehicle-price-per-week" class="w-1/2 h-12 rounded-lg border-2 border-primary pl-2" />
                                            </div>
                                            <div class="row flex justify-between gap-5">
                                                <span class="w-1/2">Specificaties:</span>
                                                <div class="specs-wrapper-1/2 flex flex-col">
                                                    <div class="specs-container flex flex-col gap-2">
                                                        <div class="specs-row flex gap-2 w-full items-center">
                                                            <div class="col-1 w-5/12">
                                                                <input name="spec_1_q" id="spec_1_q" class="w-full h-12 rounded-lg border-2 border-primary pl-2" placeholder="Accuduur"/>
                                                            </div>
                                                            <div class="col-2 w-5/12">
                                                                <input name="spec_1_a" id="spec_1_a" class="w-full h-12 rounded-lg border-2 border-primary pl-2" placeholder="3 uur"/>
                                                            </div>
                                                            <div class="col-3 w-2/12 flex items-center justify-center">
                                                                <i class="fas fa-trash text-lg"></i>
                                                            </div>
                                                        </div>
                                                        <div class="specs-row flex gap-2 w-full items-center">
                                                            <div class="col-1 w-5/12">
                                                                <input name="spec_1_q" id="spec_1_q" class="w-full h-12 rounded-lg border-2 border-primary pl-2" placeholder="Accuduur"/>
                                                            </div>
                                                            <div class="col-2 w-5/12">
                                                                <input name="spec_1_a" id="spec_1_a" class="w-full h-12 rounded-lg border-2 border-primary pl-2" placeholder="3 uur"/>
                                                            </div>
                                                            <div class="col-3 w-2/12 flex items-center justify-center">
                                                                <i class="fas fa-trash text-lg"></i>
                                                            </div>
                                                        </div>
                                                        <div class="specs-row flex gap-2 w-full items-center">
                                                            <div class="col-1 w-5/12">
                                                                <input name="spec_1_q" id="spec_1_q" class="w-full h-12 rounded-lg border-2 border-primary pl-2" placeholder="Accuduur"/>
                                                            </div>
                                                            <div class="col-2 w-5/12">
                                                                <input name="spec_1_a" id="spec_1_a" class="w-full h-12 rounded-lg border-2 border-primary pl-2" placeholder="3 uur"/>
                                                            </div>
                                                            <div class="col-3 w-2/12 flex items-center justify-center">
                                                                <i class="fas fa-trash text-lg"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="add-specs" class="add-specs flex justify-end items-center h-12">
                                                        <div class="add-spec-icon w-2/12 flex items-center justify-center">
                                                            <i class="fas fa-plus"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row select-none flex justify-start gap-5">
                                                <span class="w-1/2">Filter catagorieen:</span>
                                                <div class="filters-wrapper flex flex-col gap-5 w-1/2">
                                                    @foreach($filters as $filter)
                                                    <div data-filterid="{{ $filter->id }}" class="vehicle-filter-option-list cursor-pointer wrapper bg-white rounded-lg border-2 border-primary p-2">
                                                        <div class="title flex items-center gap-2">
                                                            <span>{{ $filter->filter_name }}</span>
                                                            <span id="toggler"><i class="fas fa-caret-down"></i></span>
                                                        </div>
                                                        <div class="selectable-list hidden">
                                                            @foreach($filter->options as $option)
                                                                <div data-optionid="{{ $option->id }}" class="option no-toggle flex gap-2 items-center">
                                                                    <input type="checkbox" id="{{ $option->value }}" class="no-toggle" />
                                                                    <label for="{{ $option->value }}" class="no-toggle" id="{{ $option->value }}">{{ $option->name }}</lab>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="buttons flex flex-row justify-end gap-5 items-center">
                                            <div class="bg-gradient-to-b w-1/8 from-red-500 flex items-start justify-between to-red-200 border-b-4 border-red-500 rounded-lg shadow-xl p-3">
                                                <div id="select-rent-vehicle-button" class="flex rounded-lg shadow-xl py-2 px-5 border-2 border-red-500 bg-red-200">
                                                    <button class="text-red-500 font-bold">Verwijder</button>
                                                </div>
                                            </div>
                                            <div class="bg-gradient-to-b w-1/8 from-green-500 flex items-start justify-between to-green-200 border-b-4 border-green-500 rounded-lg shadow-xl p-3">
                                                <div id="select-rent-vehicle-button" class="flex rounded-lg shadow-xl py-2 px-5 border-2 border-green-500 bg-green-200">
                                                    <button class="text-green-500 font-bold">Opslaan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full h-96 flex items-center justify-center hidden" id="vehicle-loader">
                                @include('components/loader')
                            </div>
                            <div id="no-vehicle-selected" class="w-full h-96 flex items-center justify-center gap-3">
                                <i class="fas fa-exclamation text-white" style="font-size: 2rem;"></i>
                                <h1 class="text-white" style="font-size: 2rem;">Selecteer een machine om deze te bewerken</h1>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</section>

@endsection