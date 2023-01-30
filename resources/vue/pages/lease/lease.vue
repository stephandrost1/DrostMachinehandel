<script>

import _ from "lodash";

export default {
    data() {
        return {
            price: 30000,
        }
    },

    computed: {
        getElements() {
            return `<a 
                href="https://lease.beequip.nl" 
                class="beequip-calculator"
                data-brand="Caterpillar"
                data-category-id="13"
                data-year="2019"
                data-model="AS 450"
                data-width="100%"
                data-height="450"
                data-color="#fff"
                data-background-color="#000"
                data-show-logo="false"
                data-primary-button-background-color="#E56D01"
                data-purchase-price="${this.price}"
                data-token="bxjTBFHyZDXGaN4DGaSMPVT6"
            ></a>`;
        },
    },

    mounted() {
        this.renderScript();
    },

    methods: {
        renderScript() {
            const element = document.querySelector("#lease-app-button-wrapper #lease-app-button");
            const scriptTag = document.createElement("script");
            scriptTag.async = true;
            scriptTag.src = "https://widgets.beequip.nl/embed-calculator.js"

            element.replaceChildren([]);
            element.appendChild(scriptTag);
        }
    },

    watch: {
        price: _.debounce(function (value) {
            this.renderScript();
        }, 250)
    }
}
</script>

<template>
    <div class="mt-4 vue-lease lease-form">
        <div class="flex flex-col gap-5">
                <div id="lease-app-button-wrapper">
                    <div class="chref" v-html="getElements"></div>
                    <div id="lease-app-button"></div>
                </div>
        </div>
    </div>
</template>