<script>

import spec from './spec.vue';

export default {
    components: {
        "dm-vehicle-spec": spec,
    },

    computed: {
        getVehicleSpecs() {
            return this.$store.getters.getSelectedVehicle.details ?? [];
        }
    },

    methods: {
        _handleAddSpec() {
            const newSpecId = this.getVehicleSpecs.length > 0 ? this.getVehicleSpecs[this.getVehicleSpecs.length - 1].id + 1 : 0;

            this.$store.commit("ADD_VEHICLE_SPEC", {
                detail_name: "",
                detail_value: "",
                id: newSpecId,
                vehicle_id: this.$store.getters.getSelectedVehicle.id,
            });
        },
    }

}

</script>

<template>
    <div class="w-full flex flex-col gap-2 items-start justify-between">
        <div
            class="input-label w-6/12 sm:w-5/12 h-12 bg-white border-2 border-primary px-4 py-1 flex items-center justify-center text-primary rounded-lg">
            <span class="w-full">Specificaties:</span>
        </div>
        <div class="specs-wrapper flex flex-col">
            <div id="vehicle-specs-container" class="specs-container flex flex-col gap-2">
                <dm-vehicle-spec v-for="spec in getVehicleSpecs" :key="spec.id" :spec="spec"></dm-vehicle-spec>
            </div>
            <div class="add-specs flex justify-end items-center h-12">
                <div id="add-specs" @click="_handleAddSpec"
                    class="add-spec-icon flex items-center justify-center p-2 bg-white rounded-full shadow-md cursor-pointer">
                    <i class="fas fa-plus text-lg text-primary"></i>
                </div>
            </div>
        </div>
    </div>
</template>