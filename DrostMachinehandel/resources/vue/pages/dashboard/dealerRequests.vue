<script>
import dealer from '../../components/dealers/dealer.vue';

import _ from "lodash";

export default {
    components: {
        "dm-dealer": dealer
    },

    data() {
        return {
            searchKey: '',
            page: 1,
        }
    },

    computed: {
        getDealers() {
            return this.$store.getters.getDealers;
        },

        getPages() {
            return this.$store.getters.getMaxPages;
        },

        getPager() {
            return this.$store.getters.getPages
        }
    },

    mounted() {
        this.$store.dispatch("fetchDealers", this.page);
    },

    methods: {
        _handlePagerClick(page) {
            this.page = page;
            this.$store.commit("SET_DEALERS", []);
            this.$store.dispatch("fetchDealers", page);
        },
    },

    watch: {
        searchKey: _.debounce(function (searchQuery) {
            this.page = 1;
            this.$store.dispatch("fetchDealers", {
                page: this.page,
                s: searchQuery
            })
        }, 500)
    }
}
</script>
<style>
html,
body {
    height: 100%;
}

@media (min-width: 1225px) {
    table {
        display: inline-table !important;
    }

    thead tr:not(:first-child) {
        display: none;
    }
}

td:not(:last-child) {
    border-bottom: 0;
}

th:not(:last-child) {
    border-bottom: 2px solid rgba(0, 0, 0, .1);
}
</style>

<template>
    <section class="w-full vue-dealer-requests">
        <div id="main" class="main-content w-full h-full flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
            <div class="bg-gray-800 pt-3">
                <div class="rounded-tl-3xl bg-gradient-to-r from-primary to-gray-800 p-4 shadow text-2xl text-white">
                    <h1 class="font-bold pl-2">Handelaren</h1>
                </div>
            </div>
            <div class="py-10 px-1 sm:px-10 min-[1225px]:px-32">
                <div class="flex justify-between">
                    <div>
                        <div class="filter-on-name w-fit">
                            <div class="flex items-center relative">
                                <input v-model="searchKey" type="text"
                                    class="searcher focus:ring-0 focus:border-primary h-10 border-2 rounded-md border-primary"
                                    placeholder="Zoeken...">
                                <i class="fas fa-search absolute text-primary right-2 pointer-events-none"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <table
                        class="w-full flex flex-row flex-no-wrap min-[1225px]:bg-white rounded-lg overflow-auto min-[1225px]:overflow-hidden min-[1225px]:shadow-lg my-5">
                        <thead class="text-white">
                            <tr v-for="dealer in getDealers" :key="dealer.id" class="bg-primary flex flex-col flex-no wrap min-[1225px]:table-row rounded-l-lg min-[1225px]:rounded-none mb-2 min-[1225px]:mb-0">
                                <th class="p-2 min-[1225px]:p-3 text-left">Naam</th>
                                <th class="p-2 min-[1225px]:p-3 text-left">E-mailadres</th>
                                <th class="p-2 min-[1225px]:p-3 text-left">Telefoonnummer</th>
                                <th class="p-2 min-[1225px]:p-3 text-left">Bedrijfsnaam</th>
                                <th class="p-2 min-[1225px]:p-3 text-left">KVK nummer</th>
                                <th class="p-2 min-[1225px]:p-3 text-left">Status</th>
                                <th class="p-2 min-[1225px]:p-3 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="flex-1 min-[1225px]:flex-none">
                            <dm-dealer v-for="dealer in getDealers" :key="dealer.id" :dealer="dealer"></dm-dealer>
                        </tbody>
                    </table>

                    <div class="flex gap-2 justify-end">
                        <div @click="_handlePagerClick(1)" v-if="(page !== 1)"
                            class="flex font-bold justify-center items-center border-2 border-primary w-9 h-9 rounded-xl cursor-pointer">
                            <i class="fas fa-angle-double-left"
                                :class="[this.page == page ? 'text-primary' : 'text-white']"></i>
                        </div>
                        <div class="flex font-bold justify-center items-center border-2 border-primary w-9 h-9 rounded-xl cursor-pointer"
                            :class="[this.page == page ? 'bg-primary' : 'bg-transparent']" :key="index"
                            v-for="page, index in getPager">
                            <div :class="[this.page == page ? 'text-white' : 'text-primary']"
                                @click="_handlePagerClick(page)">{{ page }}</div>
                        </div>
                        <div @click="_handlePagerClick(getPages)" v-if="(page !== getPages)"
                            class="flex justify-center items-center border-2 border-primary w-9 h-9 rounded-xl cursor-pointer">
                            <i class="fas fa-angle-double-right"
                                :class="[this.page == page ? 'text-primary' : 'text-white']"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>