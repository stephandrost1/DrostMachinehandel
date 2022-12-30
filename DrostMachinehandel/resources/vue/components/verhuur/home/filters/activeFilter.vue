<script>
export default {
    props: ["filter"],

    methods: {
        _handleDeleteFilter() {
            this.$store.commit("REMOVE_ACTIVE_FILTER", this.filter);
        }
    }
}
</script>


<template>
    <div class="active-filter">
        <span @click="_handleDeleteFilter" class="delete-filter-button">
            <i class="fas fa-times"></i>
        </span>
        <span class="delete-filter-name">{{ filter.name }}</span>
    </div>
</template>