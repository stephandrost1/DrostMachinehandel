<script>

export default {
    props: ["filter", "isChecked" , "groupId"],

    data() {
        return {
            filterIsChecked: this.isChecked
        }
    },

    mounted() {
        this.filterIsChecked = this.isChecked;
    }
}

</script>


<template>
    <div data-optionid="1" class="option no-toggle flex gap-2 items-center">
        <input type="checkbox" :checked="filterIsChecked" id="option name" class="no-toggle input-tag" />
        <label for="option id" class="no-toggle option-label" id="option id">{{ filter.name }}</label>
    </div>
</template>