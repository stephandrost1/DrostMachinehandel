<script>

import _ from "lodash";

export default {
    data() {
        return {
            price: 15000,
        }
    },

    computed: {
        getElements() {
            return `<a 
                href="https://lease.beequip.nl" 
                class="beequip-button"
                data-token="Xhpx7QT6xRF9ZHyABrxmm12Q"
                data-purchase-price="${this.price}"
                data-button-color="#ffffff"
                data-button-background-color="#E56D01"
                data-button-text="Open de calculator"
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
            scriptTag.src = "https://widgets.beequip.nl/embed-button.js"

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
            <div class="mt-4 lease-form">
            
                <div class="flex flex-col gap-5">
                    <div>
                        <label for="aanschafwaarde" class="block mb-2 text-white font-[800]">Aanschafwaarde</label>
                        <div class="flex w-5/12 sm:w-3/12">
                            <span
                                class="inline-flex items-center px-3 text-white font-bold bg-transparent rounded-l-md border-2 border-r-0 border-secondary">
                                <i class="fas fa-euro-sign fa-xs"></i>
                            </span>
                            <input type="number" id="aanschafwaarde" v-model="price" min="15000" 
                                class="rounded-none rounded-r-lg bg-transparent border-2 text-lg placeholder:italic text-white block flex-1 min-w-0 w-full border-secondary p-1 placeholder:text-secondary focus:border-secondary focus:ring-0"
                                placeholder="0">
                        </div>
                    </div>
            
                    <div>
                        <label for="aanschafwaarde" class="block mb-2 text-white font-[800]">Looptijd
                            <span class="font-normal text-secondary">In maanden</span></label>
                        <div class="flex w-5/12 sm:w-3/12">
                            <input type="text" id="aanschafwaarde"
                                class="rounded-none rounded-l-md rounded-r-lg bg-transparent border-2 text-lg placeholder:italic text-white block flex-1 min-w-0 w-full border-secondary p-1 placeholder:text-secondary focus:border-secondary focus:ring-0"
                                placeholder="(tussen 36 en 84 maanden)">
                        </div>
                    </div>
            
                    <div>
                        <label for="aanschafwaarde" class="block mb-2 text-white font-[800]">Aanbetaling<span
                                class="font-normal text-secondary">(tussen €3.000 en €29.999)</span></label>
                        <div class="flex w-5/12 sm:w-3/12">
                            <span
                                class="inline-flex items-center px-3 text-white font-bold bg-transparent rounded-l-md border-2 border-r-0 border-secondary">
                                <i class="fas fa-euro-sign fa-xs"></i>
                            </span>
                            <input type="text" id="aanschafwaarde"
                                class="rounded-none rounded-r-lg bg-transparent border-2 text-lg placeholder:italic text-white block flex-1 min-w-0 w-full border-secondary p-1 placeholder:text-secondary focus:border-secondary focus:ring-0"
                                placeholder="0">
                        </div>
                    </div>

                    <div>
                        <div id="lease-app-button-wrapper">
                            <div class="chref" v-html="getElements"></div>
                            <div id="lease-app-button"></div>
                        </div>
                    </div>
                </div>
            </div>
</template>