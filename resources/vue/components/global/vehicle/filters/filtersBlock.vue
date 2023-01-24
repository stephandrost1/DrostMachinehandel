<script>

import AddFilterGroup from './AddFilterGroup.vue';
import filterGroup from "./filterGroup.vue";

export default {
    components: {
        "dm-add-vehicle-filter-group": AddFilterGroup,
        "dm-vehicle-filter-group": filterGroup,
    },

    data() {
        return {
            addNewFilterPopupIsOpen: false,
        }
    },

    computed: {
        getFilterGroups() {
            return this.$store.getters.getFilters ?? [];
        },

        getLastFilterId() {
            if (this.$store.getters.getFilters && this.$store.getters.getFilters.length > 0) {
                return this.$store.getters.getFilters[this.$store.getters.getFilters.length - 1].id;
            }

            return 0;
        }
    },

    methods: {
        toggleAddNewFilterPopup() {
            this.addNewFilterPopupIsOpen = !this.addNewFilterPopupIsOpen;
        },

        _handleRejectNewFilterGroup() {
            this.toggleAddNewFilterPopup();
        },

        _handleAcceptNewFilterGroup(filterGroup) {
            this.toggleAddNewFilterPopup();
            this.$store.commit("ADD_FILTER", {
                id: this.getLastFilterId,
                filter_name: filterGroup.name,
                options: filterGroup.options.map(option => {
                    return {
                        id: option.id,
                        name: option.name,
                        value: option.name
                    }
                })
            })
        },
    }
}

</script>

<template>
    <div>
        <div class="row select-none flex flex-col justify-between gap-1">
            <dm-add-vehicle-filter-group v-show="addNewFilterPopupIsOpen"
                @_handleRejectNewFilterGroup="_handleRejectNewFilterGroup"
                @_handleAcceptNewFilterGroup="_handleAcceptNewFilterGroup"></dm-add-vehicle-filter-group>

            <div
                class="input-label w-6/12 sm:w-5/12 h-12 bg-white border-2 border-primary px-4 py-1 flex items-center justify-center text-primary rounded-lg">
                <span class="w-full">Filter categorieën:</span>
            </div>
            <div class="filters-wrapper flex flex-col items-center justify-center gap-5 w-full">
                <dm-vehicle-filter-group v-for="filter in getFilterGroups" :key="filter.id"
                    :filter-group="filter"></dm-vehicle-filter-group>
                <div class="filter-group flex items-center justify-end remove-filter-action">
                </div>
            </div>

        </div>

        <div class="flex justify-end">
            <div @click="toggleAddNewFilterPopup"
                class="wrapper flex w-min items-center justify-end p-2 bg-white rounded-full shadow-md cursor-pointer">
                <i class="fas fa-plus text-lg text-primary"></i>
            </div>
        </div>
    </div>


</template>