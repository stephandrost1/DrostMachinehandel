<script>
import loader from '../components/global/loader.vue';
import vehicleSelector from '../components/global/vehicle/sidebar/vehicleSelector.vue';
import vehicle from '../components/verhuur/vehicle.vue';
import noVehicleSelected from '../components/global/noVehicleSelected.vue'
import dialog from '../components/Dialog/dialog.vue';

export default {
    components: {
        'dm-no-vehicle-selected': noVehicleSelected,
        'dm-vehicle-loader': loader,
        'dm-vehicle': vehicle,
        'dm-sidebar': vehicleSelector,
        "dm-dialog": dialog
    },

    data() {
        return {
            currentAction: null,
            isFetchingData: false,
            // deleteMachineModal: {
            //     isOpen: false,
            // }
        }
    },

    async mounted() {
        this.$store.dispatch("fetchFilters");
    }, 

    computed: {
        hasSelectedVehicle() {
            return this.getSelectedVehicle;
        },

        isFetchingVehicle() {
            return this.isFetchingData && !this.getSelectedVehicle;
        },

        getSelectedVehicle() {
            return this.$store.getters.getSelectedVehicle;
        }
    },

    methods: {
        async _handleSelectVehicle(vehicleId) {
            this.$store.commit("SET_SELECTED_VEHICLE", null);
            this.isFetchingData = true;
            await this.$store.dispatch("fetchVehicleById", vehicleId);
            this.isFetchingData = false;
        },

        // _handleMachineDeleteReject() {
        //     this.deleteMachineModal.isOpen = false;
        // },

        // _handleMachineDeleteAccept() {
        //     this.deleteMachineModal.isOpen = false;
        // }
     }
}
</script>


<template>
    <div class="flex flex-col bg-black w-full h-full total-rental-wrapper">
        <dm-sidebar @_handleSelectVehicle="_handleSelectVehicle"></dm-sidebar>
        
        <div class="w-full p-6">
            <div
                class="bg-gradient-to-b from-primary flex items-start justify-between to-primary-200 border-b-4 border-primary rounded-lg shadow-xl p-5">
                <dm-vehicle v-if="hasSelectedVehicle"></dm-vehicle>
                <dm-vehicle-loader v-if="isFetchingVehicle"></dm-vehicle-loader>
                <dm-no-vehicle-selected v-if="!hasSelectedVehicle && !isFetchingVehicle"></dm-no-vehicle-selected>
            </div>
        </div>
    </div>
</template>