<script>
import loader from '../../components/global/loader.vue';
import vehicleSelector from '../../components/global/vehicle/sidebar/vehicleSelector.vue';
import vehicle from '../../components/verhuur/vehicle.vue';
import noVehicleSelected from '../../components/global/noVehicleSelected.vue'
import dialog from '../../components/Dialog/dialog.vue';

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
            addNew: false,
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
            return !_.isEmpty(this.getSelectedVehicle) || this.addNew;
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

        _handleAddNewVehicle() {
            this.addNew = true;
        }
    }
}
</script>


<template>
    <div class="flex flex-col lg:flex-row p-6 gap-5 bg-gray-100 w-full h-full">
        <dm-sidebar @_handleSelectVehicle="_handleSelectVehicle" extraButtonText="Toevoegen"
                    @extraButtonCallback="_handleAddNewVehicle" :hasCallback="true"></dm-sidebar>

        <div class="grow">
            <div class="bg-gradient-to-b from-primary flex items-start justify-between to-primary-200 border-b-4 border-primary rounded-lg shadow-xl p-5">
                <dm-vehicle v-if="hasSelectedVehicle" :add-vehicle="addNew"></dm-vehicle>
                <dm-vehicle-loader v-if="isFetchingVehicle"></dm-vehicle-loader>
                <dm-no-vehicle-selected v-if="!hasSelectedVehicle && !isFetchingVehicle"></dm-no-vehicle-selected>
            </div>
        </div>
    </div>
</template>