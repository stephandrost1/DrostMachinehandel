<script>

export default {
    props: {
        value: {
            type: String,
            default: "",
        },
        editable: {
            type: Boolean,
            default: true,
        }
    },

    data() {
        return {
            content: "",
        }
    },

    mounted() {
        this.content = this.value;
    },

    computed: {
        isReadOnly() {
            return !this.editable;
        }
    },

    methods: {
        _handleInput() {
            if (this.isReadOnly) {
                return;
            }

            this.$emit("_handleNameInput", this.content)
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
            <span class="w-full">Naam:</span>
        </div>
        <input placeholder="Naam" v-model="content" :readonly="isReadOnly" @change="_handleInput" class="w-1/2 h-12 rounded-lg border-2 border-primary pl-2" />
    </div>
</template>