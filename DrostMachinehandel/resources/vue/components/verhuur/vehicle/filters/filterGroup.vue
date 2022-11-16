<script>
import filter from './filter.vue';

export default {
    props: ["filterGroup"],

    components: {
        "dm-filter": filter,
    },

    data() {
        return {
            filterIsOpen: false,
        }
    },

    computed: {
        // getFilterItems() {
        //     return this.filterItems;
        // }
    },

    methods: {
        _handleFilterTogglerClick(event) {
            this.filterIsOpen = !this.filterIsOpen;
        }
    }
}

</script>


<template>
    <div data-filterid="1" class="vehicle-filter-option-list vehicle-filter-list-1 cursor-pointer wrapper bg-white rounded-lg border-2 border-primary p-2">
        <div class="title flex items-center gap-2">
            <!-- <span>{{ filterGroup.filter_name }}</span> -->
            <span id="toggler"><i class="fas fa-caret-down"></i></span>
        </div>
        <div @click="_handleFilterTogglerClick" class="list-wrapper selectable-list" v-show-slide="filterIsOpen">
            <div id="list-of-filters" class="selectable-list">
                <!-- <dm-filter :v-for="filter in filterGroup.options" :filter="filter" :isChecked="true" :groupId="filterGroup.id"></dm-filter> -->
            </div>
            <!-- <dm-add-tag></dm-add-tag> -->
    
            <div id="add-new-filter" class="underline no-toggle">
                <span class="no-toggle">Filter toevoegen</span>
            </div>
        </div>
    </div>
</template>