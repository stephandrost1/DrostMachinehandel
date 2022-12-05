<script>

export default {
    props: ["spec"],

    data() {
        return {
            specName: null,
            specValue: null,
        }
    },

    mounted() {
        this.specName = this.spec.detail_name;
        this.specValue = this.spec.detail_value;
    },  

    methods: {
        _handleRemoveSpec() {
            this.$store.commit("REMOVE_VEHICLE_SPEC_BY_ID", this.spec.id);
        },
    },

    watch: {
        specName: function(newValue) {
            this.$store.commit("UPDATE_VEHICLE_SPEC_BY_ID", {
                ...this.spec,
                detail_name: newValue,
            })
        },

        specValue: function (newValue) {
            this.$store.commit("UPDATE_VEHICLE_SPEC_BY_ID", {
                ...this.spec,
                detail_value: newValue,
            })
        }
    }
}

</script>

<template>
    <div class="specs-row flex gap-2 w-full items-center">
        <div class="col-1 w-5/12">
            <input placeholder="Naam" type="text" class="w-full h-12 spec_name rounded-lg border-2 border-primary pl-2" v-model="specName">
        </div>
        <div class="col-2 w-5/12">
            <input placeholder="Waarde" type="text" class="w-full h-12 spec_name rounded-lg border-2 border-primary pl-2" v-model="specValue">
        </div>
        <div @click="_handleRemoveSpec" class="col-3 w-2/12 flex items-center justify-center">
            <i class="fas fa-trash text-lg"></i>
        </div>
    </div>
</template>