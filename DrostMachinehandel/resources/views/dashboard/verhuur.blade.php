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
                        <div class="bg-gradient-to-b w-full from-primary flex items-start gap-5 justify-between to-primary-200 border-b-4 border-primary rounded-lg shadow-xl p-5">
                            <div id="select-rent-vehicle-wrapper" class="flex flex-col rounded-lg shadow-xl w-3/4 p-5 gap-5 border-2 border-primary-500 bg-primary-200">
                                <div id="select-rent-vehicle-toggler" class="selected-vehicle truncate overflow-hidden">
                                    <div class="option w-full hover:font-bold">
                                        <div class="label mb-1">
                                            <span class="font-bold text-primary text-lg">geselecteerd:</span>
                                        </div>
                                        <div class="p-2 bg-white border-2 border-primary rounded-lg duration-100 text-primary">
                                            <span id="selected-vehicle" class=" text-primary font-bold">Nog geen machine geselecteerd</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="options-wrapper">
                                    <div class="label mb-1">
                                        <span class="font-bold text-primary text-lg">Machines:</span>
                                    </div>
                                    <div id="select-rent-vehicle-dropdown" class="possible-options flex flex-col gap-2 duration-300">
                                        @foreach($machines as $key => $vehicle)
                                            <div class="w-full hover:font-bold">
                                                <div class="select-rent-vehicle-option p-2 bg-white border-2 border-primary rounded-lg hover:bg-primary-300 hover:text-primary duration-100 text-primary">
                                                    <span class="option-value font-bold pointer-events-none" id="{{ $vehicle->id }}">{{ $vehicle->vehicle_name }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="rent-vehicle-options-wrapper bg-primary-200 border-2 border-primary-500 rounded-lg p-5">
                                <div class="rent-vehicle-options flex flex-col gap-5">
                                    <div id="select-rent-vehicle-button" class="flex rounded-lg justify-center shadow-xl py-2 px-5 border-2 border-green-500 bg-green-200 text-green-500 hover:text-white hover:bg-green-500 duration-200 hover:border-green-200">
                                        <button class="font-bold">Selecteer</button>
                                    </div>
                                    <div id="select-rent-vehicle-button" class="flex rounded-lg justify-center shadow-xl py-2 px-5 border-2 border-blue-500 bg-blue-200 text-blue-500 hover:text-white hover:bg-blue-500 duration-200 hover:border-blue-200">
                                        <button class="font-bold">Toevoegen</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/Metric Card-->
                    </div>
                      <div class="w-full md:w-3/4 p-6">
                        <div class="bg-gradient-to-b from-primary flex items-start justify-between to-primary-200 border-b-4 border-primary rounded-lg shadow-xl p-5">
                            <div id="selected-vehicle-data" class="flex gap-5 hidden">
                                <div class="flex gap-5">
                                    <div class="col-left h-fit p-5 border-2 border-primary-500 bg-primary-200 rounded-lg flex flex-col gap-5 w-1/2">
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
                                    <div class="col-right w-1/2 p-5 border-2 border-primary-500 bg-primary-200 rounded-lg ">
                                        <div class="content flex flex-col mb-5 gap-5 w-full">
                                            <div id="selected-vehicle" class="row flex justify-between gap-5">
                                                <div class="input-label w-1/4 h-12 bg-white border-2 border-primary px-4 py-1 flex items-center justify-center text-primary rounded-lg">
                                                    <span class="w-full">Naam:</span>
                                                </div>
                                                <input placeholder="Machine 1" name="vehicleName" id="selected-vehicle-name" class="w-1/2 h-12 rounded-lg border-2 border-primary pl-2" />
                                            </div>
                                            <div class="row flex justify-between gap-5">
                                                <div class="input-label w-1/4 h-12 bg-white border-2 border-primary px-4 py-1 flex items-center justify-center text-primary rounded-lg">
                                                    <span class="w-full">Beschrijving:</span>
                                                </div>
                                                <textarea placeholder="Machine 1" name="vehicleName" id="selected-vehicle-description" rows="4" class="w-1/2 rounded-lg border-2 border-primary pl-2"></textarea>
                                            </div>
                                            <div class="row flex justify-between gap-5">
                                                <div class="input-label w-1/4 h-12 bg-white border-2 border-primary px-4 py-1 flex items-center justify-center text-primary rounded-lg">
                                                    <span class="w-full">Prijs per dag:</span>
                                                </div>
                                                <input placeholder="Machine 1" name="vehicleName" id="selected-vehicle-price-per-day" class="w-1/2 h-12 rounded-lg border-2 border-primary pl-2" />
                                            </div>
                                            <div class="row flex justify-between gap-5">
                                                <div class="input-label w-1/4 h-12 bg-white border-2 border-primary px-4 py-1 flex items-center justify-center text-primary rounded-lg">
                                                    <span class="w-full">Prijs per week:</span>
                                                </div>
                                                <input placeholder="Machine 1" name="vehicleName" id="selected-vehicle-price-per-week" class="w-1/2 h-12 rounded-lg border-2 border-primary pl-2" />
                                            </div>
                                            <div class="row flex justify-between gap-5">
                                                <div class="input-label w-1/4 h-12 bg-white border-2 border-primary px-4 py-1 flex items-center justify-center text-primary rounded-lg">
                                                    <span class="w-full">Specificaties:</span>
                                                </div>
                                                <div class="specs-wrapper w-1/2 flex flex-col">
                                                    <div id="vehicle-specs-container" class="specs-container flex flex-col gap-2">
                                                    </div>
                                                    <div class="add-specs flex justify-end items-center h-12">
                                                        <div id="add-specs" class="add-spec-icon w-2/12 flex items-center justify-center">
                                                            <i class="fas fa-plus"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row select-none flex justify-between gap-5">
                                                <div class="input-label w-1/4 h-12 bg-white border-2 border-primary px-4 py-1 flex items-center justify-center text-primary rounded-lg">
                                                    <span class="w-full">Filter categorieën:</span>
                                                </div>
                                                <div class="filters-wrapper flex flex-col gap-5 w-1/2">
                                                    @foreach($filters as $filter)
                                                    <div data-filterid="{{ $filter->id }}" class="vehicle-filter-option-list cursor-pointer wrapper bg-white rounded-lg border-2 border-primary p-2">
                                                        <div class="title flex items-center gap-2">
                                                            <span>{{ $filter->filter_name }}</span>
                                                            <span id="toggler"><i class="fas fa-caret-down"></i></span>
                                                        </div>
                                                        <div class="list-wrapper selectable-list hidden">
                                                            <div id="list-of-filters" class="selectable-list">

                                                                @foreach($filter->options as $option)
                                                                    <div data-optionid="{{ $option->id }}" class="option no-toggle flex gap-2 items-center">
                                                                        <input type="checkbox" id="{{ $option->value }}" class="no-toggle" />
                                                                        <label for="{{ $option->value }}" class="no-toggle" id="{{ $option->value }}">{{ $option->name }}</lab>
                                                                    </div>
                                                                @endforeach
                            
                                                            </div>
                                                            <div id="add-new-option-item" class="option hidden no-toggle flex gap-2 items-center my-2">
                                                                <div class="newFilter-label-wrapper no-toggle px-2 py-1 border-primary border-2 text-primary bg-white rounded-lg">
                                                                    <label for="newFilter" class="no-toggle">Naam:</label>
                                                                </div>
                                                                <input id="newFilter-input" class="no-toggle border-2 border-primary px-2 py-1 rounded-lg" />
                                                                <div class="actions no-toggle flex gap-2">
                                                                    <div id="reject-new-filter" class="reject rounded-lg no-toggle bg-white border-2 h-9 w-9 flex items-center duration-200 hover:border-red-200 hover:bg-red-500 text-red-500 hover:text-white justify-center border-primary">
                                                                        <i class="fas pointer-events-none fa-times no-toggle font-bold font-lg"></i>
                                                                    </div>
                                                                    <div id="accept-new-filter" class="accept rounded-lg no-toggle bg-white border-2 h-9 w-9 flex items-center duration-200 hover:border-green-200 hover:bg-green-500 text-green-500 hover:text-white justify-center border-primary">
                                                                        <i class="fas pointer-events-none fa-check no-toggle font-bold font-lg"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div id="add-new-filter" class="underline no-toggle">
                                                                <span class="no-toggle">Filter toevoegen</span>
                                                            </div>
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