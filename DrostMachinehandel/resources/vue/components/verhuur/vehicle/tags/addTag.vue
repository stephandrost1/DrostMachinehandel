<script>

export default {
    props: ["groupId"],

    data() {
        return {
            tagValue: null,
        }
    },

    methods: {
        _handleRejectButton() {
            this.tagValue = "";
        },

        _handleAcceptButton() {
            // this.$emit("_handleAcceptNewTag", {
            //     "value": this.tagValue,
            //     "groupId": this.groupId
            // });
        }
    }
}

</script>

<template>
    <div id="add-new-option-item" class="option hidden no-toggle flex gap-2 items-center my-2">
        <div class="newFilter-label-wrapper no-toggle px-2 py-1 border-primary border-2 text-primary bg-white rounded-lg">
            <label for="newFilter" class="no-toggle">Naam:</label>
        </div>
        <input id="newFilter-input" :value="tagValue" class="no-toggle border-2 border-primary px-2 py-1 rounded-lg" />
        <div class="actions no-toggle flex gap-2">
            <div id="reject-new-filter" @click="_handleRejectButton"
                class="reject rounded-lg no-toggle bg-white border-2 h-9 w-9 flex items-center duration-200 hover:border-red-200 hover:bg-red-500 text-red-500 hover:text-white justify-center border-primary">
                <i
                    class="fas pointer-events-none fa-times no-toggle font-bold font-lg"></i>
            </div>
            <div id="accept-new-filter" @click="_handleAcceptButton"
                class="accept rounded-lg no-toggle bg-white border-2 h-9 w-9 flex items-center duration-200 hover:border-green-200 hover:bg-green-500 text-green-500 hover:text-white justify-center border-primary">
                <i
                    class="fas pointer-events-none fa-check no-toggle font-bold font-lg"></i>
            </div>
        </div>
    </div>
</template>