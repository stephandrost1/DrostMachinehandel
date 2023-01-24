<script>

export default {
    props: ["title", "description"],

    methods: {
        _handleReject() {
            this.$emit("_handleReject");
        },

        _handleAccept() {
            this.$emit("_handleAccept");
        }
    }
}

</script>

<template>
    <div class="dialog-vue">
        <div class="modal">
            <div class="wrapper gap-5 flex flex-col">
                <div class="modal-title"><p>{{ title }}</p></div>
                <div class="modal-body"><p>{{ description }}</p></div>
                <div class="modal-actions flex items-center justify-end gap-5">
                    <div @click="_handleReject" class="flex cursor-pointer rounded-lg shadow-xl py-2 px-5 border-2 border-red-500 bg-red-200">
                        <div class="text-red-500 font-bold">Annuleren</div>
                    </div>
                    <div @click="_handleAccept" class="flex rounded-lg cursor-pointer shadow-xl py-2 px-5 border-2 border-green-500 bg-green-200">
                        <div class="text-green-500 font-bold">Akkoord</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>