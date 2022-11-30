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
        _handleRemoveSpec(specId) {
            this.vehicleSpecs = this.vehicleSpecs.filter((spec) => spec.id !== specId);
        },

        _handleAddSpec() {
            const latestSpecId = this.vehicleSpecs[this.vehicleSpecs.length - 1].id;

            this.vehicleSpecs = [...this.vehicleSpecs, { id: latestSpecId + 1 }];
        },
    }

}

</script>

<template>
    <div class="w-full flex items-start justify-between">
        <div class="input-label w-1/4 h-12 bg-white border-2 border-primary px-4 py-1 flex items-center justify-center text-primary rounded-lg">
            <span class="w-full">Specificaties:</span>
        </div>
        <div class="specs-wrapper w-1/2 flex flex-col">
            <div id="vehicle-specs-container" class="specs-container flex flex-col gap-2">
                <dm-vehicle-spec @_handleRemoveSpec="_handleRemoveSpec" v-for="spec in getVehicleSpecs" :key="spec.id" :spec="spec"></dm-vehicle-spec>
            </div>
            <div class="add-specs flex justify-end items-center h-12">
                <div id="add-specs" @click="_handleAddSpec" class="add-spec-icon w-2/12 flex items-center justify-center">
                    <i class="fas fa-plus"></i>
                </div>
            </div>
        </div>
    </div>
</template>