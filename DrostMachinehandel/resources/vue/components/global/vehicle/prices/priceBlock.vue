<script>

import priceItem from './priceItem.vue';

export default {
    props: ["pricePerDay", "pricePerWeek"],

    components: {
        "dm-price-item": priceItem,
    },

    methods: {
        _handlePricePerDay(newPrice) {
            this.$emit("_handlePricePerDay", newPrice);
        },

        _handlePricePerWeek(newPrice) {
            this.$emit("_handlePricePerWeek", newPrice);
        },
    }
}

</script>

<template>
    <div class="flex flex-col gap-5 w-full">
        <dm-price-item title="Prijs per dag" @_handleInput="_handlePricePerDay" :value="pricePerDay"></dm-price-item>
        <dm-price-item title="Prijs per week" @_handleInput="_handlePricePerWeek" :value="pricePerWeek"></dm-price-item>
    </div>
</template>