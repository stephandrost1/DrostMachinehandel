<script>

export default {
    props: {
        title: {
            type: String,
            required: true,
        },
        value: {
            type: null,
            required: true,
        },
        placeholder: {
            type: String,
            default: "Waarde..."
        },
        editable: {
            type: null,
            default: true,
        },
        type: {
            type: String,
            default: "number",
        }
    },

    data() {
        return {
            content: "",
        }
    },

    computed: {
        isReadOnly() {
            return !this.editable
        },

        getPlaceholder() {
            if (this.isReadOnly) {
                return this.value;
            }

            return this.placeholder;
        }
    },

    mounted() {
        this.content = this.formatNumber(this.value);
    },

    methods: {
        _handleInput() {
            if (this.readonly) {
                return;
            }

            this.$emit("_handleInput", this.formatNumber(this.content))
        },

        formatNumber(number) {
            return number.replace(/[^0-9]/g, '');
        }
    },

    watch: {
        value: function (newValue) {
            this.content = this.formatNumber(newValue);
        }
    }
}

</script>

<template>
    <div class="row flex justify-between gap-1">
        <div
            class="input-label w-6/12 sm:w-5/12 h-12 bg-white border-2 border-primary px-4 py-1 flex items-center justify-center text-primary rounded-lg">
            <span class="w-full">{{ title }}</span>
        </div>
        <input :placeholder="getPlaceholder" :readonly="isReadOnly" v-model="content" @change="_handleInput"
            :type="type" class="w-1/2 sm:!w-7/12 h-12 rounded-lg border-2 border-primary pl-2" />
    </div>
</template>