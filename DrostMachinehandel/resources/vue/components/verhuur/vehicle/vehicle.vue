<script>
import addFilter from './filters/addFilter.vue';
import filter from './filters/filter.vue';
import filterGroup from './filters/filterGroup.vue';
import AddFilterGroup from './filters/AddFilterGroup.vue';
import spec from './specs/spec.vue';
import vehicleImage from './images/vehicleImage.vue';
import dropzone from './images/dropzone.vue';

export default {
    components: {
        "dm-dropzone": dropzone,
        "dm-add-filter": addFilter,
        "dm-vehicle-spec": spec,
        "dm-vehicle-filter": filter,
        "dm-vehicle-filter-group": filterGroup,
        "dm-add-vehicle-filter-group": AddFilterGroup,
        "dm-vehicle-image-item": vehicleImage,
    },

    data() {
        return {
            addNewFilterPopupIsOpen: false,
            vehicle: {
                name: "",
                description: "",
                pricePerDay: "",
                pricePerWeek: "",
            }
        }
    },

    computed: {
        getVehicle() {
            return this.$store.getters.getSelectedVehicle;
        },

        getVehicleName() {
            return this.getVehicle.vehicle_name ?? "";
        },

        getVehicleDescription() {
            return this.getVehicle.vehicle_description ?? "";
        },

        getVehiclePricePerDay() {
            return this.getVehicle.price_per_day ?? "";
        },

        getVehiclePricePerWeek() {
            return this.getVehicle.price_per_week ?? "";
        },

        getVehicleSpecs() { 
            return this.getVehicle.details ?? [];
        },

        getVehicleTags() {
            return this.getVehicle.tags ?? []
        },

        getFilterGroups() {
            return this.$store.getters.getFilters ?? [];
        },

        getVehicleImages() {
            return this.getVehicle.images ?? [];
        },

        hasVehicleImages() {
            return this.getVehicleImages.length > 0
        },

        getVehicleThumbnail() {
            return this.getVehicleImages[0];
        },

        getVehicleSwiperImages() {
            return this.getVehicleImages.slice(1);
        },

        getLastFilterId() {
            if (this.$store.getters.getFilters && this.$store.getters.getFilters.length > 0) {
                return this.$store.getters.getFilters[this.$store.getters.getFilters.length - 1].id;
            }

            return 0;
        }
    },

    mounted() {
        this.vehicle.name = this.getVehicleName;
        this.vehicle.description = this.getVehicleDescription;
        this.vehicle.pricePerDay = this.getVehiclePricePerDay;
        this.vehicle.pricePerWeek = this.getVehiclePricePerWeek;
    },

    methods: {
        _handleAddVehicleSpecButton() {
            const latestSpecId = this.vehicleSpecs[this.vehicleSpecs.length - 1].id;

            this.vehicleSpecs = [...this.vehicleSpecs, { id: latestSpecId + 1 }];
        },

        _handleRemoveSpec(specId) {
            this.vehicleSpecs = this.vehicleSpecs.filter((spec) => spec.id !== specId);
        },

        toggleAddNewFilterPopup() {
            this.addNewFilterPopupIsOpen = !this.addNewFilterPopupIsOpen;
        },

        _handleRejectNewFilterGroup() {
            this.toggleAddNewFilterPopup();
        },

        _handleAcceptNewFilterGroup(filterGroup) {
            this.toggleAddNewFilterPopup();
            this.$store.commit("ADD_FILTER", {
                id: this.getLastFilterId,
                filter_name: filterGroup.name,
                options: filterGroup.options.map(option => {
                    return {
                        id: option.id,
                        name: option.name,
                        value: option.name
                    }
                })
            })
        },

        _handleDeleteVehicleButton() {
            axios.delete(`/api/v1/vehicle/${this.getVehicle.id}/delete`)
                .then((response) => {
                    this.$toast.success(response.data.message);
                }).catch((error) => {
                    this.$toast.error(error.response.data.message)
                })

            this.$store.commit("REMOVE_VEHICLE_BY_ID", this.$store.getters.getSelectedVehicle.id);
            this.$store.commit("SET_SELECTED_VEHICLE", null);
        },

        _handleSaveVehicleButton() {
            const vehicleData = {
                ...this.vehicle,
                specifications: this.getVehicleSpecs,
                tags: this.getVehicleTags,
                images: this.getVehicleImages
            }

            axios.patch(`/api/v1/vehicle/${this.getVehicle.id}/update`, vehicleData)
                .then((response) => {
                    console.log(response);
                }).catch((error) => {
                    console.log(error);
                })
        }
    },
}
</script>

<template>
    <div id="selected-vehicle-data" class="flex gap-5 w-full vue-vehicle">
        <dm-add-vehicle-filter-group v-show="addNewFilterPopupIsOpen" @_handleRejectNewFilterGroup="_handleRejectNewFilterGroup" @_handleAcceptNewFilterGroup="_handleAcceptNewFilterGroup"></dm-add-vehicle-filter-group>
        <div class="flex gap-5 w-full">
            <div class="col-left h-fit p-5 border-2 border-primary-500 bg-primary-200 rounded-lg flex flex-col gap-5 w-1/2">
                <div id="vehicle-data-thumbnail" class="row-1 h-4/5 relative">
                    <div class="no-image-available" v-if="!hasVehicleImages">
                        <img src="/img/errors/no_image_placeholder.png">
                    </div>
                    <div class="vehicle-thumb" v-if="hasVehicleImages">
                        <dm-vehicle-image-item :image="getVehicleThumbnail"></dm-vehicle-image-item>
                    </div>
                </div>
                <div class="row-2 flex gap-5 border-t-2 border-primary pt-5">
                    <div class="image-uploader w-1/4 h-1/4 aspect-square border-2 rounded-lg border-primary">
                        <dm-dropzone></dm-dropzone>
                    </div>
                    <div class="w-3/4 vehicle-swiper w-full h-1/5 user-select-none">
                        <div class="vehicle-swiper-wrapper gap-5 h-full grid grid-cols-4">
                            <dm-vehicle-image-item v-for="image in getVehicleSwiperImages" :key="image.id" :image="image"></dm-vehicle-image-item>
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
                        <input placeholder="Naam" v-model="vehicle.name" name="vehicleName" id="selected-vehicle-name"
                            class="w-1/2 h-12 rounded-lg border-2 border-primary pl-2" />
                    </div>
                    <div class="row flex justify-between gap-5">
                        <div
                            class="input-label w-1/4 h-12 bg-white border-2 border-primary px-4 py-1 flex items-center justify-center text-primary rounded-lg">
                            <span class="w-full">Beschrijving:</span>
                        </div>
                        <textarea placeholder="Beschrijving" v-model="vehicle.description" name="vehicleName" id="selected-vehicle-description"
                            rows="4" class="w-1/2 rounded-lg border-2 border-primary pl-2"></textarea>
                    </div>
                    <div class="row flex justify-between gap-5">
                        <div
                            class="input-label w-1/4 h-12 bg-white border-2 border-primary px-4 py-1 flex items-center justify-center text-primary rounded-lg">
                            <span class="w-full">Prijs per dag:</span>
                        </div>
                        <input placeholder="Prijs per dag" v-model="vehicle.pricePerDay" type="number" name="vehicleName"
                            id="selected-vehicle-price-per-day"
                            class="w-1/2 h-12 rounded-lg border-2 border-primary pl-2" />
                    </div>
                    <div class="row flex justify-between gap-5">
                        <div
                            class="input-label w-1/4 h-12 bg-white border-2 border-primary px-4 py-1 flex items-center justify-center text-primary rounded-lg">
                            <span class="w-full">Prijs per week:</span>
                        </div>
                        <input placeholder="Prijs per week" v-model="vehicle.pricePerWeek" type="number" name="vehicleName"
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
                                <dm-vehicle-spec @_handleRemoveSpec="_handleRemoveSpec" v-for="spec in getVehicleSpecs" :key="spec.id" :spec="spec"></dm-vehicle-spec>
                            </div>
                            <div class="add-specs flex justify-end items-center h-12">
                                <div id="add-specs" @click="_handleAddVehicleSpecButton" class="add-spec-icon w-2/12 flex items-center justify-center">
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
                            <dm-vehicle-filter-group v-for="filter in getFilterGroups" :key="filter.id" :filter-group="filter"></dm-vehicle-filter-group>
                            <div class="filter-group flex items-center justify-end remove-filter-action">
                                <div @click="toggleAddNewFilterPopup" class="wrapper flex items-center justify-center">
                                    <i class="fas fa-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="buttons mt-6 flex flex-row justify-end gap-5 items-center">
                    <div id="delete-selected-vehicle"
                        class="bg-gradient-to-b w-1/8 from-red-500 flex items-start justify-between to-red-200 border-b-4 border-red-500 rounded-lg shadow-xl p-3">
                        <div id="delete-rent-vehicle-button" @click="_handleDeleteVehicleButton" class="flex cursor-pointer rounded-lg shadow-xl py-2 px-5 border-2 border-red-500 bg-red-200">
                            <div class="text-red-500 font-bold">Verwijder</div>
                        </div>
                    </div>
                    <div id="save-selected-vehicle"
                        class="bg-gradient-to-b w-1/8 from-green-500 flex items-start justify-between to-green-200 border-b-4 border-green-500 rounded-lg shadow-xl p-3">
                        <div id="select-rent-vehicle-button" @click="_handleSaveVehicleButton" class="flex rounded-lg cursor-pointer shadow-xl py-2 px-5 border-2 border-green-500 bg-green-200">
                            <div class="text-green-500 font-bold">Opslaan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>