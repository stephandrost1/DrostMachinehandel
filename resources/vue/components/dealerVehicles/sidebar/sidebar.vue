<script>
import vehicleItemVue from './item.vue'

export default {
    data() {
        return {
            query: '',
        }
    },

    components: {
        "dm-sidebar-vehicle-item": vehicleItemVue
    },
    computed: {
        getVehicles() {
            const query = this.query.toLowerCase().trim();
            const vehicles = this.$store.getters.getVehicles;

            // If query is empty, return all vehicles
            if (query === '') {
                return vehicles;
            }

            // Filter vehicles by vehicle_name containing or starting with query
            return vehicles.filter((vehicle) => {
                const vehicleName = vehicle.vehicle_name.toLowerCase();
                return vehicleName.includes(query) || vehicleName.startsWith(query);
            });
        }
    },
    mounted() {
        this.$store.dispatch("fetchVehicles")
    },
    methods: {
        _handleSelectVehicle(vehicle) {
            this.$emit("_handleSelectVehicle", vehicle.id);
        },

        _handleFetchButton() {
            this.$toast.success("Alle machines worden ingeladen, dit kan even duren");

            axios.get('/api/v1/dealer/vehicles/fetch')
                .then((response) => {
                    this.$toast.success(response.data.message);
                    this.$store.dispatch("fetchVehicles");
                }).catch((error) => {
                    this.$toast.error(error.response.data.message)
                })
        }
    }
}
</script>

<template>
    <div class="h-fit flex">
        <div
            class="bg-gradient-to-b w-full from-primary flex flex-col 2xl:flex-row items-start gap-5 justify-between to-primary-200 border-b-4 border-primary rounded-lg shadow-xl p-5">
            <div id="select-rent-vehicle-wrapper"
                class="flex flex-col rounded-lg shadow-xl w-full p-5 gap-5 border-2 border-primary-500 bg-primary-200">
                <div class="options-wrapper">
                    <div class="searchbar vue-searchbar">
                        <input type="text" v-model="query" placeholder="Zoeken...">
                        <i class="fas fa-search search"></i>
                    </div>
                    <div class="label mb-1">
                        <span class="font-bold text-primary text-lg">Machines:</span>
                    </div>
                    <div id="select-rent-vehicle-dropdown" class="possible-options flex flex-col gap-2 duration-300">
                        <dm-sidebar-vehicle-item @click="_handleSelectVehicle(vehicle)" v-for="vehicle in getVehicles"
                            :key="vehicle.id" :vehicle-name="vehicle.vehicle_name"
                            :vehicle-id="vehicle.id"></dm-sidebar-vehicle-item>
                    </div>
                </div>
            </div>
            <div class="rent-vehicle-options-wrapper bg-primary-200 border-2 border-primary-500 rounded-lg p-5">
                <div class="rent-vehicle-options flex flex-col gap-5">
                    <div @click="_handleFetchButton" class="flex rounded-lg justify-center shadow-xl py-2 px-5 border-2 border-blue-500 bg-blue-200 text-blue-500 hover:text-white hover:bg-blue-500 duration-200 hover:border-blue-200">
                        <button class="font-bold">Ophalen</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>