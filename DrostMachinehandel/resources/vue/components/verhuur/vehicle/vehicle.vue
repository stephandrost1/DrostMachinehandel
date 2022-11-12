<script>

export default {

}

</script>

<template>
    <div class="w-full md:w-3/4 p-6">
        <div
            class="bg-gradient-to-b from-primary flex items-start justify-between to-primary-200 border-b-4 border-primary rounded-lg shadow-xl p-5">
            <div id="selected-vehicle-data" class="flex gap-5 hidden w-full">
                <div class="flex gap-5 w-full">
                    <div
                        class="col-left h-fit p-5 border-2 border-primary-500 bg-primary-200 rounded-lg flex flex-col gap-5 w-1/2">
                        <div id="vehicle-data-thumbnail" class="row-1 h-4/5 relative">
                            <div class="no-image-available hidden">
                                <img src="/img/errors/no_image_placeholder.png">
                            </div>
                        </div>
                        <div class="row-2 flex gap-5 border-t-2 border-primary pt-5">
                            <div class="image-uploader w-1/4 h-1/4 aspect-square border-2 rounded-lg border-primary">
                                <div class="w-full flex items-center justify-center h-full">
                                    <div class="flex justify-center items-center h-full w-full">
                                        <label for="dropzone-file"
                                            class="flex flex-col justify-center items-center w-full h-full cursor-pointer">
                                            <div class="flex flex-col justify-center items-center h-full pt-5 pb-6">
                                                <svg aria-hidden="true" class="mb-3 w-10 h-10 text-primary" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                    </path>
                                                </svg>
                                                <p class="mb-2 text-sm text-center text-primary"><span
                                                        class="font-semibold">Click to upload</span> or drag and
                                                    drop</p>
                                                <p class="text-xs text-center text-primary">SVG, PNG, JPG or GIF
                                                    (MAX. 800x400px)</p>
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
                                <div
                                    class="input-label w-1/4 h-12 bg-white border-2 border-primary px-4 py-1 flex items-center justify-center text-primary rounded-lg">
                                    <span class="w-full">Naam:</span>
                                </div>
                                <input placeholder="Machine 1" name="vehicleName" id="selected-vehicle-name"
                                    class="w-1/2 h-12 rounded-lg border-2 border-primary pl-2" />
                            </div>
                            <div class="row flex justify-between gap-5">
                                <div
                                    class="input-label w-1/4 h-12 bg-white border-2 border-primary px-4 py-1 flex items-center justify-center text-primary rounded-lg">
                                    <span class="w-full">Beschrijving:</span>
                                </div>
                                <textarea placeholder="Machine 1" name="vehicleName" id="selected-vehicle-description"
                                    rows="4" class="w-1/2 rounded-lg border-2 border-primary pl-2"></textarea>
                            </div>
                            <div class="row flex justify-between gap-5">
                                <div
                                    class="input-label w-1/4 h-12 bg-white border-2 border-primary px-4 py-1 flex items-center justify-center text-primary rounded-lg">
                                    <span class="w-full">Prijs per dag:</span>
                                </div>
                                <input placeholder="Machine 1" type="number" name="vehicleName"
                                    id="selected-vehicle-price-per-day"
                                    class="w-1/2 h-12 rounded-lg border-2 border-primary pl-2" />
                            </div>
                            <div class="row flex justify-between gap-5">
                                <div
                                    class="input-label w-1/4 h-12 bg-white border-2 border-primary px-4 py-1 flex items-center justify-center text-primary rounded-lg">
                                    <span class="w-full">Prijs per week:</span>
                                </div>
                                <input placeholder="Machine 1" type="number" name="vehicleName"
                                    id="selected-vehicle-price-per-week"
                                    class="w-1/2 h-12 rounded-lg border-2 border-primary pl-2" />
                            </div>
                            <div class="row flex justify-between gap-5">
                                <div
                                    class="input-label w-1/4 h-12 bg-white border-2 border-primary px-4 py-1 flex items-center justify-center text-primary rounded-lg">
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
                                <div
                                    class="input-label w-1/4 h-12 bg-white border-2 border-primary px-4 py-1 flex items-center justify-center text-primary rounded-lg">
                                    <span class="w-full">Filter categorieën:</span>
                                </div>
                                <div class="filters-wrapper flex flex-col gap-5 w-1/2">
                                    <div data-filterid="1"
                                        class="vehicle-filter-option-list vehicle-filter-list-1 cursor-pointer wrapper bg-white rounded-lg border-2 border-primary p-2">
                                        <div class="title flex items-center gap-2">
                                            <span>Filter name</span>
                                            <span id="toggler"><i class="fas fa-caret-down"></i></span>
                                        </div>
                                        <div class="list-wrapper selectable-list hidden">
                                            <div id="list-of-filters" class="selectable-list">
                                                <div data-optionid="1" class="option no-toggle flex gap-2 items-center">
                                                    <input type="checkbox" id="option name" class="no-toggle input-tag" />
                                                    <label for="option id" class="no-toggle option-label"
                                                        id="option id">Option name</label>
                                                </div>
                                            </div>
                                            <div id="add-new-option-item"
                                                class="option hidden no-toggle flex gap-2 items-center my-2">
                                                <div
                                                    class="newFilter-label-wrapper no-toggle px-2 py-1 border-primary border-2 text-primary bg-white rounded-lg">
                                                    <label for="newFilter" class="no-toggle">Naam:</label>
                                                </div>
                                                <input id="newFilter-input"
                                                    class="no-toggle border-2 border-primary px-2 py-1 rounded-lg" />
                                                <div class="actions no-toggle flex gap-2">
                                                    <div id="reject-new-filter"
                                                        class="reject rounded-lg no-toggle bg-white border-2 h-9 w-9 flex items-center duration-200 hover:border-red-200 hover:bg-red-500 text-red-500 hover:text-white justify-center border-primary">
                                                        <i
                                                            class="fas pointer-events-none fa-times no-toggle font-bold font-lg"></i>
                                                    </div>
                                                    <div id="accept-new-filter"
                                                        class="accept rounded-lg no-toggle bg-white border-2 h-9 w-9 flex items-center duration-200 hover:border-green-200 hover:bg-green-500 text-green-500 hover:text-white justify-center border-primary">
                                                        <i
                                                            class="fas pointer-events-none fa-check no-toggle font-bold font-lg"></i>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div id="add-new-filter" class="underline no-toggle">
                                                <span class="no-toggle">Filter toevoegen</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="buttons flex flex-row justify-end gap-5 items-center">
                            <div id="delete-selected-vehicle"
                                class="bg-gradient-to-b w-1/8 from-red-500 flex items-start justify-between to-red-200 border-b-4 border-red-500 rounded-lg shadow-xl p-3">
                                <div id="delete-rent-vehicle-button"
                                    class="flex rounded-lg shadow-xl py-2 px-5 border-2 border-red-500 bg-red-200">
                                    <div class="text-red-500 font-bold">Verwijder</div>
                                </div>
                            </div>
                            <div id="save-selected-vehicle"
                                class="bg-gradient-to-b w-1/8 from-green-500 flex items-start justify-between to-green-200 border-b-4 border-green-500 rounded-lg shadow-xl p-3">
                                <div id="select-rent-vehicle-button"
                                    class="flex rounded-lg shadow-xl py-2 px-5 border-2 border-green-500 bg-green-200">
                                    <div class="text-green-500 font-bold">Opslaan</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>