<script>
import loader from '../../components/global/loader.vue';
import noVehicleSelected from '../../components/global/noVehicleSelected.vue'
import sidebar from '../../components/maintenance/sidebar/sidebar.vue';
import dialog from '../../components/Dialog/dialog.vue';
import vehicle from '../../components/maintenance/vehicle.vue';

export default {
    components: {
        'dm-no-vehicle-selected': noVehicleSelected,
        'dm-vehicle-loader': loader,
        'dm-vehicle': vehicle,
        'dm-sidebar': sidebar,
        "dm-dialog": dialog
    },

    data() {
        return {
            addNew: false,
        }
    },

    computed: {
        getVehicles() {
            return this.$store.getters.getVehicles;
        },

        getSelectedVehicle() {
            return this.$store.getters.getSelectedVehicle;
        },

        hasSelectedVehicle() {
            return !_.isEmpty(this.getSelectedVehicle) || this.addNew;
        },
    },

    methods: {
        _handleSelectVehicle(id) {
            this.$store.dispatch("fetchVehicleById", id);
            this.addNew = false;
        },

        _handleAddNewVehicle() {
            this.addNew = true;
            this.$store.commit("SET_SELECTED_VEHICLE", []);
        },

        _toggleAddVehicleProp(status) {
            this.addNew = status;
        }
    }
}    

</script>

<template>
        <div class="flex flex-col lg:flex-row p-6 gap-5 bg-gray-100 w-full h-full vue-maintenance">
            <div class="sidebar">
                <dm-sidebar 
                    @_handleSelectVehicle="_handleSelectVehicle"
                    @_handleAddButton="_handleAddNewVehicle"
                    ></dm-sidebar>
            </div>
        
            <div class="grow content">
                <div class="bg-gradient-to-b from-primary flex items-start justify-between to-primary-200 border-b-4 border-primary rounded-lg shadow-xl p-5">
                    <dm-vehicle @_toggleAddVehicleProp="_toggleAddVehicleProp" v-if="hasSelectedVehicle" :add-vehicle="addNew"></dm-vehicle>
                    <dm-no-vehicle-selected v-if="!hasSelectedVehicle"></dm-no-vehicle-selected>
                </div>
            </div>
        </div>
</template>