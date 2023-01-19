<script>
import loader from '../../components/global/loader.vue';
import noVehicleSelected from '../../components/global/noVehicleSelected.vue'
import vehicleSelector from '../../components/global/vehicle/sidebar/vehicleSelector.vue';
import dialog from '../../components/Dialog/dialog.vue';
import vehicle from '../../components/maintenance/vehicle.vue';

export default {
    components: {
        'dm-no-vehicle-selected': noVehicleSelected,
        'dm-vehicle-loader': loader,
        'dm-vehicle': vehicle,
        'dm-sidebar': vehicleSelector,
        "dm-dialog": dialog
    },

    computed: {
        getVehicles() {
            return this.$store.getters.getVehicles;
        },

        getSelectedVehicle() {
            return this.$store.getters.getSelectedVehicle;
        },

        hasSelectedVehicle() {
            return !_.isEmpty(this.getSelectedVehicle);
        }
    },

    methods: {
        _handleSelectVehicle(id) {
            this.$store.dispatch("fetchVehicleById", id);
        }
    }
}    

</script>

<template>
        <div class="flex flex-col lg:flex-row p-6 gap-5 bg-gray-100 w-full h-full vue-maintenance">
            <div class="sidebar">
                <dm-sidebar @_handleSelectVehicle="_handleSelectVehicle" extraButtonText="Toevoegen"
                    @extraButtonCallback="_handleFetchVehicles" :hasCallback="true"></dm-sidebar>
            </div>
        
            <div class="grow content">
                <div class="bg-gradient-to-b from-primary flex items-start justify-between to-primary-200 border-b-4 border-primary rounded-lg shadow-xl p-5">
                    <dm-vehicle v-if="hasSelectedVehicle" :vehicle="getSelectedVehicle"></dm-vehicle>
                    <dm-no-vehicle-selected v-if="!hasSelectedVehicle"></dm-no-vehicle-selected>
                </div>
            </div>
        </div>
</template>