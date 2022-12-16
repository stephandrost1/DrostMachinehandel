<script>
import specsBlock from "./specs/specsBlock.vue";
import vehicleImage from './images/vehicleImage.vue';
import dropzone from './images/dropzone.vue';
import nameBlock from './name/nameBlock.vue';
import descriptionBlock from './description/descriptionBlock.vue';
import priceBlock from './prices/priceBlock.vue';
import FiltersBlock from './filters/filtersBlock.vue';
import delivery from './delivery/delivery.vue';

export default {
    components: {
        "dm-dropzone": dropzone,

        "dm-vehicle-specs-block": specsBlock,
        "dm-vehicle-name-block": nameBlock,
        "dm-vehicle-description-block": descriptionBlock,
        "dm-vehicle-price-block": priceBlock,
        "dm-vehicle-filters-block": FiltersBlock,
        "dm-delivery-options-block": delivery,

        "dm-vehicle-image-item": vehicleImage,
    },

    data() {
        return {
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
    },

    mounted() {
        this.vehicle.name = this.getVehicleName;
        this.vehicle.description = this.getVehicleDescription;
        this.vehicle.pricePerDay = this.getVehiclePricePerDay;
        this.vehicle.pricePerWeek = this.getVehiclePricePerWeek;
    },

    methods: {
        _handleNameInput(name) {
            this.vehicle.name = name;
        },

        _handleDescriptionInput(description) {
            this.vehicle.description = description;
        },

        _handlePricePerDay(newPrice) {
            this.vehicle.pricePerDay = newPrice;
        },

        _handlePricePerWeek(newPrice) {
            this.vehicle.pricePerWeek = newPrice;
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
            console.log("update");

            const vehicleData = {
                ...this.vehicle,
                id: this.getVehicle.id,
                specifications: this.getVehicleSpecs,
                activeTags: this.$store.getters.getActiveFilters,
                tags: this.$store.getters.getFilters,
                images: this.getVehicleImages
            }

            axios.patch(`/api/v1/vehicle/${this.getVehicle.id}/update`, vehicleData)
                .then((response) => {
                    this.$toast.success(response.data.message);
                }).catch((error) => {
                    this.$toast.error(error.response.data.message)
                })

            this.$store.commit("UPDATE_VEHICLE_NAME_BY_ID", {
                vehicleId: this.getVehicle.id,
                vehicleName: this.vehicle.name,
            });
        }
    },
}
</script>

<template>
    <div id="selected-vehicle-data" class="flex gap-5 w-full vue-vehicle">
        <div class="flex flex-col xl:flex-row gap-5 w-full vehicle-wrapper">
            <div class="col-left h-fit p-5 border-2 border-primary-500 bg-primary-200 rounded-lg flex flex-col gap-5">
                <div id="vehicle-data-thumbnail" class="row-1 h-4/5 relative">
                    <div class="no-image-available" v-if="!hasVehicleImages">
                        <img src="/img/errors/no_image_placeholder.png">
                    </div>
                    <div class="vehicle-thumb" v-if="hasVehicleImages">
                        <dm-vehicle-image-item :image="getVehicleThumbnail"></dm-vehicle-image-item>
                    </div>
                </div>
                <div class="row-2 flex gap-5 border-t-2 border-primary pt-5">
                    <div class="image-uploader w-full border-2 rounded-lg border-primary">
                        <dm-dropzone></dm-dropzone>
                    </div>
                    <div class="vehicle-swiper w-auto user-select-none">
                        <div class="vehicle-swiper-wrapper gap-5 h-full grid grid-cols-4">
                            <dm-vehicle-image-item v-for="image in getVehicleSwiperImages" :key="image.id" :image="image"></dm-vehicle-image-item>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-right p-5 border-2 border-primary-500 bg-primary-200 rounded-lg ">
                <div class="content flex flex-col mb-5 gap-5 w-full">
                    <dm-vehicle-name-block @_handleNameInput="_handleNameInput" :value="vehicle.name"></dm-vehicle-name-block>

                    <dm-vehicle-description-block @_handleDescriptionInput="_handleDescriptionInput" :value="vehicle.description"></dm-vehicle-description-block>

                    <dm-delivery-options-block></dm-delivery-options-block>
         
                    <dm-vehicle-price-block @_handlePricePerDay="_handlePricePerDay" @_handlePricePerWeek="_handlePricePerWeek" :pricePerDay="vehicle.pricePerDay" :pricePerWeek="vehicle.pricePerWeek"></dm-vehicle-price-block>
                    
                    <dm-vehicle-specs-block></dm-vehicle-specs-block>
                    
                    <dm-vehicle-filters-block></dm-vehicle-filters-block>
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