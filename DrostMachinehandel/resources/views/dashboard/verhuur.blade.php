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
            <div class="confirmation-box popup-confirmation-box absolute top-0 left-0 w-full h-full z-10 flex hidden justify-center items-center">
                <div class="content-box rounded-lg border-2 border-primary bg-white">
                    <div class="header">
                        <span class="title">Weet je zeker dat je deze machine wilt verwijderen?</span>
                    </div>
                    <div class="buttons">
                        <div class="reject">
                            <div class="flex rounded-lg shadow-xl py-2 px-5 border-2 border-red-500 bg-red-200">
                                <button id="popup-cancel-button" class="text-red-500 font-bold">Annuleren</button>
                            </div>
                        </div>
                        <div class="accept">
                            <div class="flex rounded-lg shadow-xl py-2 px-5 border-2 border-green-500 bg-green-200">
                                <button id="popup-accept-button" class="text-green-500 font-bold">Verwijderen</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="flex flex-wrap bg-black h-full">
                    <div class="w-full h-fit md:w-1/4 p-6 flex">
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
                                        <div id="vehicle-data-thumbnail" class="row-1 h-4/5 relative">
                                            <div class="no-image-available hidden">
                                                <img src="/img/errors/no_image_placeholder.png">
                                            </div>                         
                                        </div>
                                        <div class="row-2 flex gap-5">
                                            <div class="image-uploader w-1/4 h-1/4 aspect-square border-2 rounded-lg border-primary">
                                                <div class="w-full flex items-center justify-center h-full">
                                                        <div class="flex justify-center items-center h-full w-full">
                                                            <label for="dropzone-file" class="flex flex-col justify-center items-center w-full h-full cursor-pointer">
                                                                <div class="flex flex-col justify-center items-center h-full pt-5 pb-6">
                                                                    <svg aria-hidden="true" class="mb-3 w-10 h-10 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                                                    <p class="mb-2 text-sm text-center text-primary"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                                                    <p class="text-xs text-center text-primary">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                                                                </div>
                                                                <input id="dropzone-file" multiple type="file" class="hidden">
                                                            </label>
                                                        </div> 
                                                </div>
                                            </div>
                                            <div class="w-3/4 vehicle-swiper w-full h-1/5 user-select-none">
                                                <div class="vehicle-swiper-wrapper gap-5 h-full grid grid-cols-4">
                                                </div>
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
                                                    <div data-filterid="{{ $filter->id }}" class="vehicle-filter-option-list vehicle-filter-list-{{$filter->id}} cursor-pointer wrapper bg-white rounded-lg border-2 border-primary p-2">
                                                        <div class="title flex items-center gap-2">
                                                            <span>{{ $filter->filter_name }}</span>
                                                            <span id="toggler"><i class="fas fa-caret-down"></i></span>
                                                        </div>
                                                        <div class="list-wrapper selectable-list hidden">
                                                            <div id="list-of-filters" class="selectable-list">

                                                                @foreach($filter->options as $option)
                                                                    <div data-optionid="{{ $option->id }}" class="option no-toggle flex gap-2 items-center">
                                                                        <input type="checkbox" id="{{ $option->value }}" class="no-toggle" />
                                                                        <label for="{{ $option->value }}" class="no-toggle option-label" id="{{ $option->value }}">{{ $option->name }}</lab>
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
                                            <div id="delete-selected-vehicle" class="bg-gradient-to-b w-1/8 from-red-500 flex items-start justify-between to-red-200 border-b-4 border-red-500 rounded-lg shadow-xl p-3">
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