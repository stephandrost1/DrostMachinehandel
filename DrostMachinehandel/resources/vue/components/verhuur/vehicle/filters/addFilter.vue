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
            this.$emit("_handleRejectNewFilter");
        },

        _handleAcceptButton() {
            this.$emit("_handleAcceptNewFilter", {
                "value": this.tagValue,
                "groupId": this.groupId
            });
            this.tagValue = "";
        }
    }
}

</script>

<template>
    <div id="add-new-option-item" class="option no-toggle flex flex-col gap-2 my-2">
        <div class="flex gap-2">
            <div
                class="newFilter-label-wrapper no-toggle px-2 py-1 border-primary border-2 w-1/2 text-primary bg-white rounded-lg">
                <label for="newFilter" class="no-toggle">Naam:</label>
            </div>
            <input id="newFilter-input" v-model="tagValue"
                class="no-toggle border-2 w-2/4 border-primary px-2 py-1 rounded-lg" />
        </div>
        <div class="actions no-toggle flex gap-2">
            <div id="reject-new-filter" @click="_handleRejectButton"
                class="reject p-2 w-[38px] rounded-lg no-toggle bg-white border-2 h-9 flex items-center duration-200 hover:bg-red-500 text-red-500 hover:text-white justify-center border-primary">
                <i class="fas pointer-events-none fa-times no-toggle font-bold text-lg"></i>
            </div>
            <div id="accept-new-filter" @click="_handleAcceptButton"
                class="accept p-2 rounded-lg no-toggle bg-white border-2 h-9 flex items-center duration-200 hover:bg-green-500 text-green-500 hover:text-white justify-center border-primary">
                <i class="fas pointer-events-none fa-check no-toggle font-bold text-lg"></i>
            </div>
        </div>
    </div>
</template>