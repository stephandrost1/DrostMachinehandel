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
                return this.content;
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

            this.$emit("_handleInput", this.content)
        },

        formatNumber(number) {
            // Use a regular expression to remove all but the first decimal point from the string
            let strippedStr = number.replace(/\./g, "$&,").replace(/(^,|,$)/g, "");

            // Use a regular expression to split the string into groups of three digits
            let groups = strippedStr.match(/\d{1,3}/g);

            // Join the groups with a decimal point
            let formatted = groups.join(".");

            return formatted;
        }
    },

    watch: {
        content: function (newValue) {
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
            type="number" class="w-1/2 sm:!w-7/12 h-12 rounded-lg border-2 border-primary pl-2" />
    </div>
</template>