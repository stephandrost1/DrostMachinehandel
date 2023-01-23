<script>

export default {
    props: ["value"],

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
            this.$emit("_handleDescriptionInput", this.content)
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
            class="input-label w-6/12 sm:w-5/12 h-12 bg-white border-2 border-primary px-4 py-1 flex items-center justify-center text-primary rounded-lg">
            <span class="w-full">Beschrijving:</span>
        </div>
        <textarea placeholder="Beschrijving" v-model="content" @change="_handleInput" rows="4"
            class="w-1/2 sm:!w-7/12 rounded-lg border-2 border-primary pl-2"></textarea>
    </div>
</template>