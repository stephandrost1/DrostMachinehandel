<script>
import addFilter from './addFilter.vue';
import filter from './filter.vue';

export default {
    props: ["filterGroup"],

    components: {
        "dm-filter": filter,
        "dm-add-filter": addFilter
    },

    data() {
        return {
            filterIsOpen: false,
            addNewFilter: false,
        }
    },

    computed: {
        getGroupId() {
            return this.filterGroup.id;
        }
    },

    methods: {
        _handleAddNewFilterClick() {
            this.addNewFilter = true;
        },

        _handleFilterToggler() {
            this.filterIsOpen = !this.filterIsOpen;
        },

        _handleRejectNewFilter() {
            this.addNewFilter = false;
        },

        getFilterById(filterId) {
            return this.$store.getters.getFilters.filter((filter) => filter.id == filterId);
        },

        _handleAcceptNewFilter(newFilter) {
            let filterGroup = JSON.parse(JSON.stringify(this.getFilterById(this.getGroupId))).shift();

            if (filterGroup.length > 0) {
                return;
            }

            if (!filterGroup.options.some(option => option.name.toLowerCase() == newFilter.value.toLowerCase())) {
                this.$store.commit("SET_NEW_FILTER_OPTION", {
                    filterId: this.getGroupId,
                    option: {
                        name: newFilter.value,
                        value: newFilter.value,
                        filter_id: newFilter.groupId,
                        isActive: false,
                    }
                });
            }

            this.addNewFilter = false;
        },

        _handleRemoveFilterGroup() {
            this.$store.commit("REMOVE_FILTER_GROUP_BY_ID", this.getGroupId);
        }
    }
}

</script>

<template>
    <div class="vue-filter-group flex gap-2 w-full">
        <div
            class="w-full vehicle-filter-list-1 cursor-pointer wrapper bg-white rounded-lg border-2 border-primary p-2">
            <div class="title flex items-center gap-2 pl-1" @click="_handleFilterToggler">
                <span>{{ filterGroup.filter_name }}</span>
                <span id="toggler"><i class="fas fa-caret-down"></i></span>
            </div>
            <div class="list-wrapper selectable-list overflow-hidden duration-300"
                :class="[filterIsOpen ? 'max-h-96' : 'max-h-0']">
                <div id="list-of-filters" class="selectable-list pl-1 flex flex-col gap-2">
                    <dm-filter v-for="filter in filterGroup.options" :key="filter.id" :filter="filter"
                        :group-id="filterGroup.id"></dm-filter>
                </div>
                <dm-add-filter v-if="addNewFilter" :group-id="getGroupId"
                    @_handleRejectNewFilter="_handleRejectNewFilter"
                    @_handleAcceptNewFilter="_handleAcceptNewFilter"></dm-add-filter>

                <div id="add-new-filter" @click="_handleAddNewFilterClick" class="underline no-toggle pl-1">
                    <span class="no-toggle">Filter toevoegen</span>
                </div>
            </div>
        </div>
        <div class="flex items-center">
            <div @click="_handleRemoveFilterGroup"
                class="action remove-filter-group flex items-center justify-center p-2 bg-white rounded-full shadow-md cursor-pointer">
                <i class="fas fa-trash text-lg text-red-600"></i>
            </div>
        </div>
    </div>
</template>