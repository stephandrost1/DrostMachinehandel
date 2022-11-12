<script>
import axios from 'axios';
import _ from "lodash";
import loader from '../components/loader.vue';
import vehicleSelectorVue from '../components/verhuur/sidebar/vehicleSelector.vue';
import vehicle from '../components/verhuur/vehicle/vehicle.vue';
import noVehicleSelected from '../components/verhuur/vehicle/noVehicleSelected.vue'

export default {
    components: {
        'dm-no-vehicle-selected': noVehicleSelected,
        'dm-vehicle-loader': loader,
        'dm-vehicle': vehicle,
        'dm-sidebar': vehicleSelectorVue,
    },

    data() {
        return {
            vehicles: [],
            currentAction: null,
            selectedVehicle: {
                vehicle_name: "Nog geen machine geselecteerd",
                id: null,
            }
        }
    },

    mounted() {
        this.fetchVehicles()
    }, 

    computed: {
        hasSelectedVehicleData() {
            return true;
        },

        isFetchingVehicleData() {
            return false;
        }
    },

    methods: {
        fetchVehicles() {
            axios.get('/dashboard/vehicles')
                .then((response) => {
                    this.vehicles = response.data.vehicles;
                })
        },

        _handleSelectVehicle(vehicle) {
            this.selectedVehicle = vehicle;
        },

        async _handleSelectButton() {
            if (_.isNull(this.selectedVehicle.id)) {
                return;
            }

            this.selectedVehicle = await this.fetchVehicleById(this.selectedVehicle.id);
        },

        async fetchVehicleById(id) {
            return await axios.get(`/api/v1/vehicle/${id}`).then((response) => {
                return response.data.vehicle
            })
        }
     }  
}
</script>


<template>
    <section class="w-full">
        <div id="main" class="main-content w-full h-full flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
            <div class="bg-gray-800 pt-3">
                <div class="rounded-tl-3xl bg-gradient-to-r from-primary to-gray-800 p-4 shadow text-2xl text-white">
                    <h1 class="font-bold pl-2">Machines verhuur</h1>
                </div>
            </div>
            <!-- <div
                class="confirmation-box popup-confirmation-box absolute top-0 left-0 w-full h-full z-10 flex hidden justify-center items-center">
                <div class="content-box rounded-lg border-2 border-primary bg-white">
                    <div class="header">
                        <span class="title">Weet je zeker dat je deze machine wilt verwijderen?</span>
                    </div>
                    <div class="buttons">
                        <div class="reject">
                            <div class="flex rounded-lg shadow-xl py-2 px-5 border-2 border-red-500 bg-red-200">
                                <button id="popup-cancel-button" class="text-red-500 font-bold">Annuleren</button>
                            </div>
                        </div>
                        <div class="accept">
                            <div class="flex rounded-lg shadow-xl py-2 px-5 border-2 border-green-500 bg-green-200">
                                <button id="popup-accept-button" class="text-green-500 font-bold">Verwijderen</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="flex flex-wrap bg-black h-full">
                <dm-sidebar @_handleSelectButton="_handleSelectButton"  @_handleSelectVehicle="_handleSelectVehicle" :selectedVehicle="selectedVehicle" :vehicles="vehicles"></dm-sidebar>
                
                <template>
                    <dm-vehicle v-if="isFetchingVehicleData" :vehicle="selectedVehicle"></dm-vehicle>
                    <!-- <dm-vehicle-loader v-if="isFetchingVehicleData"></dm-vehicle-loader> -->
                    <!-- <dm-no-vehicle-selected v-if="!this.hasSelectedVehicleData"></dm-no-vehicle-selected> -->
                </template>
            </div>
        </div>
    </section>
</template>