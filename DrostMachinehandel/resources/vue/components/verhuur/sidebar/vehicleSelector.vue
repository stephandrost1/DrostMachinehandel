<script>
import vehicleItemVue from './vehicleItem.vue'
export default {
    props: ["selectedVehicle", "vehicles"],

    components: {
        "dm-sidebar-vehicle-item": vehicleItemVue
    },

    methods: {
        _handleSelectVehicle(vehicle) {
            this.$emit("_handleSelectVehicle", vehicle);
        },

        _handleSelectButton() {
            this.$emit("_handleSelectButton");
        }
    }
}
</script>


<template>
    <div class="w-full h-fit md:w-1/4 p-6 flex">
        <div class="bg-gradient-to-b w-full from-primary flex items-start gap-5 justify-between to-primary-200 border-b-4 border-primary rounded-lg shadow-xl p-5">
            <div id="select-rent-vehicle-wrapper" class="flex flex-col rounded-lg shadow-xl w-3/4 p-5 gap-5 border-2 border-primary-500 bg-primary-200">
                <div id="select-rent-vehicle-toggler" class="selected-vehicle truncate overflow-hidden">
                    <div class="option w-full hover:font-bold">
                        <div class="label mb-1">
                            <span class="font-bold text-primary text-lg">geselecteerd:</span>
                        </div>
                       <div class="p-2 bg-white border-2 border-primary rounded-lg duration-100 text-primary">
                            <span :id="selectedVehicle.id" class="text-primary font-bold">{{ selectedVehicle.vehicle_name }}</span>
                        </div>
                    </div>
                </div>
                <div class="options-wrapper">
                    <div class="label mb-1">
                        <span class="font-bold text-primary text-lg">Machines:</span>
                    </div>
                    <div id="select-rent-vehicle-dropdown" class="possible-options flex flex-col gap-2 duration-300">
                        <dm-sidebar-vehicle-item @click="_handleSelectVehicle(vehicle)" v-for="vehicle in vehicles" :key="vehicle.id" :vehicle-name="vehicle.vehicle_name" :vehicle-id="vehicle.id"></dm-sidebar-vehicle-item>
                    </div>
                </div>
            </div>
            <div class="rent-vehicle-options-wrapper bg-primary-200 border-2 border-primary-500 rounded-lg p-5">
                <div class="rent-vehicle-options flex flex-col gap-5">
                    <div @click="_handleSelectButton" class="flex rounded-lg justify-center shadow-xl py-2 px-5 border-2 border-green-500 bg-green-200 text-green-500 hover:text-white hover:bg-green-500 duration-200 hover:border-green-200">
                        <button class="font-bold">Selecteer</button>
                    </div>
                    <div id="create-rent-vehicle-button" class="flex rounded-lg justify-center shadow-xl py-2 px-5 border-2 border-blue-500 bg-blue-200 text-blue-500 hover:text-white hover:bg-blue-500 duration-200 hover:border-blue-200">
                        <button class="font-bold">Toevoegen</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>