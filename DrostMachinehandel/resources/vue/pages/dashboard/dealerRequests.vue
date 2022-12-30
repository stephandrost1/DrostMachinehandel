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
table tbody {
    display: table;
    width: 100%;
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
            <div class="flex flex-wrap h-full">
                <div class="table">
                    <div class="dealer-table-header">
                        <div class="actions">
                            <div class="col-left">
                                <div class="filter-on-name">
                                    <div class="input">
                                        <input v-model="searchKey" type="text" class="searcher focus:ring-0"
                                            placeholder="Zoeken...">
                                        <i class="fas fa-search search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-[#e0e0e0] rounded-md p-2">
                        <table
                            class="table w-full border-collapse mb-4 overflow-x-auto max-w-fit m-auto whitespace-nowrap">
                            <tr class="text-primary font-bold border-b-2 border-primary">
                                <td class="px-1 py-3 w-1/12">
                                    <p>Naam</p>
                                </td>
                                <td class="px-1 py-3 w-1/12">
                                    <p>E-mailadres</p>
                                </td>
                                <td class="px-1 py-3 w-1/12">
                                    <p>Telefoonnummer</p>
                                </td>
                                <td class="px-1 py-3 w-1/12">
                                    <p>Bedrijfsnaam</p>
                                </td>
                                <td class="px-1 py-3 w-1/12">
                                    <p>KVK nummer</p>
                                </td>
                                <td class="px-1 py-3 w-1/12">
                                    <p>Status</p>
                                </td>
                                <td class="px-1 py-3 w-1/12">
                                    <p>Acties</p>
                                </td>
                            </tr>

                            <dm-dealer v-for="dealer in getDealers" :key="dealer.id" :dealer="dealer"></dm-dealer>
                        </table>

                        <div class="table-footer">
                            <div class="pager">
                                <div @click="_handlePagerClick(1)" v-if="(page !== 1)" class="pager-item">
                                    <i class="pager-counter fas fa-angle-double-left"></i>
                                </div>
                                <div class="pager-item" :class="[this.page == page ? 'active' : 'inactive']"
                                    :key="index" v-for="page, index in getPager">
                                    <div class="pager-counter" @click="_handlePagerClick(page)">{{ page }}</div>
                                </div>
                                <div @click="_handlePagerClick(getPages)" v-if="(page !== getPages)" class="pager-item">
                                    <i class="pager-counter fas fa-angle-double-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</template>