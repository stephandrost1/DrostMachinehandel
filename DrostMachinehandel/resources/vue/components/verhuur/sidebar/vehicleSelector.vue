<script>

import vehicleItemVue from './vehicleItem.vue'

export default {
    components: {
        "dm-sidebar-vehicle-item": vehicleItemVue
    },

    computed: {
        getVehicles() {
            return this.$store.getters.getVehicles;
        }
    },

    mounted() {
        this.$store.dispatch("fetchVehicles")
    },

    methods: {
        _handleSelectVehicle(vehicle) {
            this.$emit("_handleSelectVehicle", vehicle.id);
        },
    }
}
</script>


<template>
    <div class="w-full h-fit md:w-1/4 p-6 flex">
        <div class="bg-gradient-to-b w-full from-primary flex items-start gap-5 justify-between to-primary-200 border-b-4 border-primary rounded-lg shadow-xl p-5">
            <div id="select-rent-vehicle-wrapper" class="flex flex-col rounded-lg shadow-xl w-3/4 p-5 gap-5 border-2 border-primary-500 bg-primary-200">
                <div class="options-wrapper">
                    <div class="label mb-1">
                        <span class="font-bold text-primary text-lg">Machines:</span>
                    </div>
                    <div id="select-rent-vehicle-dropdown" class="possible-options flex flex-col gap-2 duration-300">
                        <dm-sidebar-vehicle-item @click="_handleSelectVehicle(vehicle)" v-for="vehicle in getVehicles" :key="vehicle.id" :vehicle-name="vehicle.vehicle_name" :vehicle-id="vehicle.id"></dm-sidebar-vehicle-item>
                    </div>
                </div>
            </div>
            <div class="rent-vehicle-options-wrapper bg-primary-200 border-2 border-primary-500 rounded-lg p-5">
                <div class="rent-vehicle-options flex flex-col gap-5">
                    <div id="create-rent-vehicle-button" class="flex rounded-lg justify-center shadow-xl py-2 px-5 border-2 border-blue-500 bg-blue-200 text-blue-500 hover:text-white hover:bg-blue-500 duration-200 hover:border-blue-200">
                        <button class="font-bold">Toevoegen</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>