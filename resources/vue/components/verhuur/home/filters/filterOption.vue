<script>

export default {
    props: ["option"],

    computed: {
        filterIsActive() {
            return this.$store.getters.getActiveFilters.some((f) => f.id === this.option.id);
        }
    },

    methods: {
        _handleFilterClick(e) {
            if (e.target.checked) {
                this.$store.commit("ADD_ACTIVE_FILTER", this.option);
            } else {
                this.$store.commit("REMOVE_ACTIVE_FILTER", this.option);
            }
        }
    }
}
</script>


<template>
   <input type="checkbox" :checked="filterIsActive" @click="_handleFilterClick" class="filter-item focus:border-transparent focus:ring-0"> {{ option.name }} <br>
</template>