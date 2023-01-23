<script>
import FilterOption from './filterOption.vue';


export default {
    props: ["filter"],

    components: {
        "dm-filter-option": FilterOption
    }
}

</script>

<template>
    <div class="filter-wrapper">
        <span class="filter-name">{{ filter.filter_name }}<i class="fas fa-chevron-up filter-arrow"></i>
        </span><br>
        <div class="filter-items-wrapper">
            <dm-filter-option v-for="option in filter.options" :key="option.id" :option="option"></dm-filter-option>
        </div>
    </div>
</template>