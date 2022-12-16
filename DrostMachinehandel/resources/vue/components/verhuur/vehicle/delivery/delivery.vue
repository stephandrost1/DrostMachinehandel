<script>
import option from './option.vue'

export default {
    props: ["options"],

    compontents: {
        "dm-delivery-option": option
    },


}

</script>

<template>
    <div class="row flex justify-between gap-5">
        <div
            class="input-label w-1/4 h-12 bg-white border-2 border-primary px-4 py-1 flex items-center justify-center text-primary rounded-lg">
            <span class="w-full">Levertijd</span>
        </div>
        <input placeholder="Prijs per week" v-model="content" @change="_handleInput" type="number"
            class="w-1/2 h-12 rounded-lg border-2 border-primary pl-2" />
    </div>
</template>