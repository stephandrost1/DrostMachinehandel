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
        },

        _handleTrashClick() {
            this.$store.commit("REMOVE_FILTER_OPTION_BY_ID", {
                filterId: this.filter.filter_id,
                optionId: this.filter.id
            });
        }
    }
}

</script>


<template>
    <div data-optionid="1" class="option no-toggle flex gap-2 items-center justify-between">
        <div class="flex gap-2 items-center">
            <input type="checkbox" @click="_handleFilterOptionClick" :checked="filterIsChecked" id="option name" class="no-toggle input-tag" />
            <label for="option id" class="no-toggle option-label" id="option id">{{ filter.name }}</label>
        </div>
        <div class="flex trash" @click="_handleTrashClick">
            <i class="fas fa-trash text-lg"></i>
        </div>
    </div>
</template>