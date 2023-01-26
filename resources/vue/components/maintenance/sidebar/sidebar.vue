<script>
import searchbarVue from './searchbar.vue';
import vehicleItemVue from './vehicleItem.vue'

export default {
    props: {
        extraButtonText: {
            type: String,
            "default": "Toevoegen",
        },
        hasCallback: {
            type: Boolean,
            "default": false
        },
    },

    components: {
        "dm-sidebar-vehicle-item": vehicleItemVue,
        "dm-searchbar": searchbarVue,
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

        _handleAddButton() {
            this.$emit("_handleAddButton", true);
        },
    }
}
</script>


<template>
    <div class="basis-4/12 min-[1150px]:basis-3/12 h-fit flex">
        <div class="bg-gradient-to-b w-full from-primary flex flex-col items-start gap-5 justify-between to-primary-200 border-b-4 border-primary rounded-lg shadow-xl p-5">
            <div class="search-bar flex w-full rounded-xl">
                <dm-searchbar></dm-searchbar>
            </div>
            <div class="wrapper w-full flex flex-col xl:flex-row gap-5">
                <div id="select-rent-vehicle-wrapper"
                    class="flex flex-col rounded-lg shadow-xl w-full p-5 gap-5 border-2 border-primary-500 bg-primary-200">
                    <div class="options-wrapper">
                        <div class="label mb-1">
                            <span class="font-bold text-primary text-lg">Machines:</span>
                        </div>
                        <div id="select-rent-vehicle-dropdown" class="possible-options flex flex-col gap-2 duration-300">
                            <template v-if="getVehicles.length > 0">
                                <dm-sidebar-vehicle-item @click="_handleSelectVehicle(vehicle)" v-for="vehicle in getVehicles" :key="vehicle.id" :vehicle-name="vehicle.vehicle_name" :vehicle-id="vehicle.id"></dm-sidebar-vehicle-item>
                            </template>
                   
                            <template v-else><p>Er zijn nog geen machines toegevoegd!</p></template>
                        </div>
                    </div>
                </div>
                <div class="rent-vehicle-options-wrapper shadow-xl bg-primary-200 border-2 border-primary-500 rounded-lg p-5">
                    <div class="rent-vehicle-options flex flex-col gap-5">
                        <div @click="_handleAddButton"
                            class="flex rounded-lg justify-center shadow-xl py-2 px-5 border-2 border-blue-500 bg-blue-200 text-blue-500 hover:text-white hover:bg-blue-500 duration-200 hover:border-blue-200">
                            <button class="font-bold">Toevoegen</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>