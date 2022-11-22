<script>

export default {
    props: ["filter"],

    data() {
        return {
            filterData: {
                name: "",
                id: null,
            }
        }
    },

    mounted() {
        if (this.filter.filterName !== "") {
            this.filterData.name = this.filter.filterName;
        }

        this.filterData.id = this.filter.id;
    },

    methods: {
        _handleRemoveFilter() {
            this.$emit("_handleRemoveFilter", this.filterData.id);
        },
    },

    watch: {
        "filterData.name": function () {
            this.$emit("_updateFilterValue", this.filterData);
        }
    }
}

</script>


<template>
    <div class="option">
        <div class="name">
            <p>Naam:</p>
        </div>
        <div class="value">
            <input class="filter-value" v-model="filterData.name" />
            <div class="removeButton" @click="_handleRemoveFilter">
                <i class="fas fa-trash text-lg remove-icon"></i>
            </div>
        </div>
    </div>
</template>