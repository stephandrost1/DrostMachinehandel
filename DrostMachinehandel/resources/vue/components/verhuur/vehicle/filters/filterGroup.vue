<script>

export default {
    props: ["filter"]
}

</script>


<template>
    <div data-filterid="1" class="vehicle-filter-option-list vehicle-filter-list-1 cursor-pointer wrapper bg-white rounded-lg border-2 border-primary p-2">
        <div class="title flex items-center gap-2">
            <span>{{ filter.filter_name }}</span>
            <span id="toggler"><i class="fas fa-caret-down"></i></span>
        </div>
        <div class="list-wrapper selectable-list hidden">
            <div id="list-of-filters" class="selectable-list">
                <!-- <dm-vehicle-tag :v-for="getVehicleTags in tag" :tag="tag" :isChecked="true" :groupId="1"></dm-vehicle-tag> -->
            </div>
            <!-- <dm-add-tag></dm-add-tag> -->
    
            <div id="add-new-filter" class="underline no-toggle">
                <span class="no-toggle">Filter toevoegen</span>
            </div>
        </div>
    </div>
</template>