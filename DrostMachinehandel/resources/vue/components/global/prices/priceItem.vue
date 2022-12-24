<script>

export default {
    props: ["title", "value"],

    data() {
        return {
            content: "",
        }
    },

    mounted() {
        this.content = this.value;
    },

    methods: {
        _handleInput() {
            this.$emit("_handleInput", this.content)
        }
    },

    watch: {
        value: function (newValue) {
            this.content = newValue;
        }
    }
}

</script>

<template>
    <div class="row flex justify-between gap-1">
        <div
            class="input-label w-5/12 h-12 bg-white border-2 border-primary px-4 py-1 flex items-center justify-center text-primary rounded-lg">
            <span class="w-full">{{ title }}</span>
        </div>
        <input placeholder="Prijs per week" v-model="content" @change="_handleInput" type="number" class="w-1/2 h-12 rounded-lg border-2 border-primary pl-2" />
    </div>
</template>