<script>
import axios from 'axios';
import vehicleImage from '../global/vehicle/images/vehicleImage.vue';
import nameBlock from '../global/vehicle/name/nameBlock.vue';
import priceItem from '../global/vehicle/prices/priceItem.vue';

export default {
    components: {
        "dm-name-block": nameBlock,
        "dm-price": priceItem,
        "dm-image-item": vehicleImage,
    },

    computed: {
        getVehicle() {
            return this.$store.getters.getSelectedVehicle;
        },

        getName() {
            return this.getVehicle.vehicle_name ?? "";
        },

        getThumbnail() {
            return this.getVehicle.image ?? "";
        },

        getPrice() {
            return this.getVehicle.price ?? 0;
        },

        getDealerPrice() {
            return this.getVehicle.dealer_price ?? 0;
        },

        hasThumbnail() {
            return this.getThumbnail !== null;
        },
    },

    methods: {
        _handleDealerPriceInput(newPrice) {
            console.log("handleNewPRice", newPrice);
            this.$store.commit("SET_VEHICLE_DEALER_PRICE", newPrice);
        },

        _handleCancelVehicleButton() {
            this.$store.commit("SET_SELECTED_VEHICLE", []);
        },

        _handleSaveVehicleButton() {
            this.$store.commit("UPDATE_VEHICLE_DEALER_PRICE", this.getVehicle);

            axios.patch(`/api/v1/dealer/vehicles/${this.getVehicle.id}/update`, this.getVehicle)
                .then((response) => {
                    this.$toast.success(response.data.message);
                }).catch((error) => {
                    this.$toast.error(error.response.data.message)
                })
        },
    },
}
</script>

<template>
    <div id="selected-vehicle-data" class="flex gap-5 w-full vue-vehicle">
        <div class="flex flex-col xl:flex-row gap-5 w-full vehicle-wrapper">
            <div
                class="col-left max-w-[350px] min-[1150px]:max-w-[450px] h-fit p-5 border-2 border-primary-500 bg-primary-200 rounded-lg flex flex-col gap-5">
                <div id="vehicle-data-thumbnail" class="row-1 h-4/5 relative">
                    <div class="no-image-available" v-if="!hasThumbnail">
                        <img src="../../../../public/img/errors/no_image_placeholder.png">
                    </div>
                    <div class="vehicle-thumb" v-if="hasThumbnail">
                        <dm-image-item :image="getThumbnail"></dm-image-item>
                    </div>
                </div>
            </div>
            <div class="col-right grow p-5 border-2 border-primary-500 bg-primary-200 rounded-lg ">
                <div class="content flex flex-col mb-5 gap-5 w-full">
                    <dm-name-block :value="getName" :editable="false"></dm-name-block>

                    <dm-price title="Prijs particulieren" :value="getPrice" :editable="false"></dm-price>

                    <dm-price title="Prijs handelaren" @_handleInput="_handleDealerPriceInput" :value="getDealerPrice"
                        type="text"></dm-price>
                </div>
                <div class="buttons mt-6 flex flex-row justify-end gap-5 items-center">
                    <div id="delete-selected-vehicle">
                        <div id="delete-rent-vehicle-button" @click="_handleCancelVehicleButton"
                            class="flex cursor-pointer rounded-lg shadow-xl py-2 px-5 border-2 border-red-500 bg-red-200">
                            <div class="text-red-500 font-bold">Annuleren</div>
                        </div>
                    </div>
                    <div id="save-selected-vehicle" @click="_handleSaveVehicleButton">
                        <div
                            class="cursor-pointer flex w-min rounded-lg shadow-xl py-2 px-5 border-2 border-green-500 bg-green-200 text-green-500 font-bold">
                            Opslaan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>