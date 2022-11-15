<script>

export default {
    props: ["tag", "isChecked" , "groupId"],

    data() {
        return {
            tagIsChecked: this.isChecked
        }
    }
}

</script>


<template>
    <div data-optionid="1" class="option no-toggle flex gap-2 items-center">
        <input type="checkbox" :value="tagIsChecked" id="option name" class="no-toggle input-tag" />
        <label for="option id" class="no-toggle option-label" id="option id">Option name</label>
    </div>
</template>