<script>

export default {
    props: ["filter", "groupId"],

    data() {
        return {
            filterIsChecked: this.filter.isActive
        }
    },

    mounted() {
        this.filterIsChecked = this.filter.isActive;
    },

    methods: {
        _handleFilterOptionClick(event) {
            this.$store.commit("SET_FILTER_OPTION_STATUS", {
                filterId: this.filter.filter_id,
                optionName: this.filter.name,
                isActive: event.target.checked,
            })
        }
    }
}

</script>


<template>
    <div data-optionid="1" class="option no-toggle flex gap-2 items-center">
        <input type="checkbox" @click="_handleFilterOptionClick" :checked="filterIsChecked" id="option name" class="no-toggle input-tag" />
        <label for="option id" class="no-toggle option-label" id="option id">{{ filter.name }}</label>
    </div>
</template>