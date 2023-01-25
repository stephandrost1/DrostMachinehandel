<script>
import { mapGetters } from 'vuex';
import actionVue from './action.vue';
import newActionVue from './newAction.vue';

export default {
    props: ["addVehicle"],

    data() {
        return {
            newVehicle: {
                vehicle_name: "",
                mark: "",
                type: "",
                serial_number: "",
                construction_year: "",
                reference_number: "",
            }
        }
    },

    components: {
        "dm-action": actionVue,
        "dm-new-action": newActionVue,
    },

    computed: {
        ...mapGetters(["getActionsObject"]),

        vehicle() {
            return this.$store.getters.getSelectedVehicle;
        },
    },

    methods: {
        _handleSaveNewVehicle() {
            this.$emit("_toggleAddVehicleProp", false)
            this.$store.dispatch("addNewVehicle", this.newVehicle);
        },

        _handleDeleteVehicle() {
            this.$store.dispatch("deleteVehicle", this.vehicle.id);
        },

        _handleEditVehicle() {
            this.newVehicle.vehicle_name = this.vehicle.vehicle_name;
            this.newVehicle.mark = this.vehicle.mark;
            this.newVehicle.type = this.vehicle.type;
            this.newVehicle.construction_year = this.vehicle.construction_year;
            this.newVehicle.serial_number = this.vehicle.serial_number;
            this.newVehicle.reference_number = this.vehicle.reference_number;
            this.$emit("_toggleAddVehicleProp", true);
        }
    },
}

</script>

<template>
        <div class="flex gap-5 w-full vue-maintenance-vehicle">
            <div class="wrapper flex flex-col min-[680px]:flex-row md:flex-col min-[880px]:flex-row lg:flex-col min-[1150px]:flex-row gap-5 w-full">
                <div class="column-left column bg-primary-200 border-2 border-primary rounded-lg shadow-xl p-5">
                    <div class="vehicle-item title">
                        <p class="name">Naam:</p>
                        <p v-if="!addVehicle" class="value">{{ vehicle.vehicle_name }}</p>
                        <input v-else type="text" class="vehicle-input" v-model="newVehicle.vehicle_name" /> 
                    </div>
                    <div class="vehicle-item mark">
                        <p class="name">Merk:</p>
                        <p v-if="!addVehicle" class="value">{{ vehicle.mark }}</p>
                        <input v-else type="text" class="vehicle-input" v-model="newVehicle.mark" />
                    </div>
                    <div class="vehicle-item type">
                        <p class="name">Type:</p>
                        <p v-if="!addVehicle" class="value">{{ vehicle.type }}</p>
                        <input v-else type="text" class="vehicle-input" v-model="newVehicle.type" />
                    </div>
                    <div class="vehicle-item serial-number">
                        <p class="name">Serienummer:</p>
                        <p v-if="!addVehicle" class="value">{{ vehicle.serial_number }}</p>
                        <input v-else type="text" class="vehicle-input" v-model="newVehicle.serial_number" />
                    </div>
                    <div class="vehicle-item construction-year">
                        <p class="name">Bouwjaar:</p>
                        <p v-if="!addVehicle" class="value">{{ vehicle.construction_year }}</p>
                        <input v-else type="text" class="vehicle-input" v-model="newVehicle.construction_year" />
                    </div>
                    <div class="vehicle-item reference-number">
                        <p class="name">Referentienummer:</p>
                        <p v-if="!addVehicle" class="value">{{ vehicle.reference_number }}</p>
                        <input v-else type="text" class="vehicle-input" v-model="newVehicle.reference_number" />
                    </div>
                    <div class="vehicle-item actions-buttons flex justify-end gap-5 mt-5">
                        <div v-if="addVehicle" @click="_handleSaveNewVehicle"
                            class="flex rounded-lg justify-center shadow-xl py-2 px-5 border-2 border-green-500 bg-green-200 text-green-500 hover:text-white hover:bg-green-500 duration-200 hover:border-green-200">
                            <button class="font-bold">Opslaan</button>
                        </div>
                        <div v-if="!addVehicle" @click="_handleEditVehicle"
                            class="flex rounded-lg justify-center shadow-xl py-2 px-5 border-2 border-orange-500 bg-orange-200 text-orange-500 hover:text-white hover:bg-orange-500 duration-200 hover:border-orange-200">
                            <button class="font-bold">Bewerken</button>
                        </div>
                        <div v-if="!addVehicle" @click="_handleDeleteVehicle"
                            class="flex rounded-lg justify-center shadow-xl py-2 px-5 border-2 border-red-500 bg-red-200 text-red-500 hover:text-white hover:bg-red-500 duration-200 hover:border-red-200">
                            <button class="font-bold">Verwijderen</button>
                        </div>
                    </div>
                </div>

                <div class="column-right column bg-primary-200 border-2 border-primary rounded-lg shadow-xl p-5">
                    <div class="body flex">
                        <div class="col-left">
                            <dm-new-action v-if="!addVehicle"></dm-new-action>
                            <div v-else>Sla eerst de nieuwe machine op voordat u acties kunt toevoegen!</div>

                            <dm-action v-for="action in getActionsObject.left" :key="action.id" :action="action"></dm-action>
                        </div>
                        <div class="col-right">
                            <dm-action v-for="action in getActionsObject.right" :key="action.id" :action="action"></dm-action>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>