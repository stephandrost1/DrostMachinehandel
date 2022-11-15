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
        if (this.spec.detail_name && this.spec.detail_value) {
            this.specName = this.spec.detail_name;
            this.specValue = this.spec.detail_value;
        }
    },  

    computed: {
        getSpecNameInputName() {
            return `spec_${this.spec.id}_name`;
        },

        getSpecValueInputName() {
            return `spec_${this.spec.id}_value`;
        },
    },

    methods: {
        _handleRemoveSpec() {
            this.$emit("_handleRemoveSpec", this.spec.id);
        }
    },
}

</script>

<template>
    <div class="specs-row flex gap-2 w-full items-center">
        <div class="col-1 w-5/12">
            <input placeholder="Naam" type="text" :id="getSpecNameInputName" class="w-full h-12 spec_name rounded-lg border-2 border-primary pl-2" v-model="specName">
        </div>
        <div class="col-2 w-5/12">
            <input placeholder="Waarde" type="text" :id="getSpecValueInputName" class="w-full h-12 spec_name rounded-lg border-2 border-primary pl-2" v-model="specValue">
        </div>
        <div @click="_handleRemoveSpec" class="col-3 w-2/12 flex items-center justify-center">
            <i class="fas fa-trash text-lg"></i>
        </div>
    </div>
</template>