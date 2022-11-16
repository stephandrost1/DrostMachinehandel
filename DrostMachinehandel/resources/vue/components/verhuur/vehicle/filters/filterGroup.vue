<script>
import addFilter from './addFilter.vue';
import filter from './filter.vue';

export default {
    props: ["filterGroup", "checkedFilters"],

    components: {
        "dm-filter": filter,
        "dm-add-filter": addFilter
    },

    data() {
        return {
            filterIsOpen: false,
            filterOptions: [],
            activeFilters: [],
            addNewFilter: false,
        }
    },

    mounted() {
        this.activeFilters = JSON.parse(JSON.stringify(this.checkedFilters));
        this.filterOptions = JSON.parse(JSON.stringify(this.filterGroup.options));
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
        
        _handleAcceptNewFilter(newFilter) {
            if (this.filterOptions.some(filter => filter.name.toLowerCase() !== newFilter.value.toLowerCase())) {
                this.filterOptions.push({
                    name: newFilter.value,
                    value: newFilter.value,
                    filter_id: newFilter.groupId
                })
            }

            this.addNewFilter = false;
        },

        calculateFilterIsChecked(filter) {
            return this.activeFilters.some(f => {
                return f.id === filter.id
            });
        },

    }
}

</script>

<template>
    <div data-filterid="1" class="vehicle-filter-option-list vehicle-filter-list-1 cursor-pointer wrapper bg-white rounded-lg border-2 border-primary p-2">
        <div class="title flex items-center gap-2 pl-1" @click="_handleFilterToggler">
            <span>{{ filterGroup.filter_name }}</span>
            <span id="toggler"><i class="fas fa-caret-down"></i></span>
        </div>
        <div class="list-wrapper selectable-list overflow-hidden duration-300" :class="[ filterIsOpen ? 'max-h-96' : 'max-h-0' ]" v-show-slide="filterIsOpen">
            <div id="list-of-filters" class="selectable-list pl-1">
                <dm-filter v-for="filter in filterOptions" :key="filter.id" :filter="filter" :is-checked="calculateFilterIsChecked(filter)" :group-id="filterGroup.id"></dm-filter>
            </div>
            <dm-add-filter v-if="addNewFilter" :group-id="filterGroup.id" @_handleRejectNewFilter="_handleRejectNewFilter" @_handleAcceptNewFilter="_handleAcceptNewFilter"></dm-add-filter>  
    
            <div id="add-new-filter" @click="_handleAddNewFilterClick" class="underline no-toggle pl-1">
                <span class="no-toggle">Filter toevoegen</span>
            </div>
        </div>
    </div>
</template>