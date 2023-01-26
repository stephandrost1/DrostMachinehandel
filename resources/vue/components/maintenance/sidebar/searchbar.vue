<script>

import _ from "lodash";

export default {
    data() {
        return {
            searchQuery: "",
        }
    },

    watch: {
        searchQuery: _.debounce(function (value) {
            this.$store.dispatch("filterVehiclesByQuery", value);
        }, 250)
    }
}

</script>

<template>
    <div class="flex w-full vue-searchbar rounded-lg shadow-xl border-2 border-primary-500 bg-primary-200 relative">
        <input type="text" v-model="searchQuery" class="w-full rounded-lg bg-primary-200 border-none" placeholder="Zoeken....">
        <div class="search-icon absolute right-1 top-3 flex items-center pr-3">
            <i class="fas fa-search icon text-primary"></i>
        </div>
    </div>
</template>