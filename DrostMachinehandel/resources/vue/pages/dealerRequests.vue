<script>
import dealer from '../components/dealers/dealer.vue';

import _ from "lodash";

export default {
    components: {
        "dm-dealer": dealer
    },

    data() {
        return {
            searchKey: '',
            searchKeyDebouncer: '',
            page: 1,
        }
    },

    computed: {
        getDealers() {
            const filteredByName = _.filter(this.$store.getters.getDealers, (dealer) => `${dealer.firstname} ${dealer.lastname}`.toLowerCase().includes(this.searchKey.toLowerCase()));
            const filteredByKvk = _.filter(this.$store.getters.getDealers, (dealer) => dealer.kvknumber.toLowerCase().includes(this.searchKey.toLowerCase()));
            const filteredByEmail = _.filter(this.$store.getters.getDealers, (dealer) => dealer.email.toLowerCase().includes(this.searchKey.toLowerCase()));
            const filteredByCompanyname = _.filter(this.$store.getters.getDealers, (dealer) => dealer.companyname.toLowerCase().includes(this.searchKey.toLowerCase()));

            const dealers = filteredByName.concat(filteredByKvk, filteredByEmail, filteredByCompanyname)

            return dealers.filter((item, index) => index === dealers.indexOf(item));;
        },

        getPages() {
            return this.$store.getters.getPages;
        },

        getPager() {
            if (this.page === 1) {
                return [this.page, this.page + 1, this.page + 2];
            } else if (this.page + 1 > this.getPages) {
                return [this.page - 2, this.page - 1, this.page];
            } else {
                return [this.page - 1, this.page, this.page + 1];
            }
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

        updateSearchKey(key) {
            this.searchKey = key;
        },
    },

    watch: {
        searchKeyDebouncer: _.debounce(function (value) {
            this.searchKey = value;
        }, 500)
    }
}
</script>


<template>
    <section class="w-full vue-dealer-requests">
        <div id="main" class="main-content w-full h-full flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
            <div class="bg-gray-800 pt-3">
                <div class="rounded-tl-3xl bg-gradient-to-r from-primary to-gray-800 p-4 shadow text-2xl text-white">
                    <h1 class="font-bold pl-2">Account aanvragen handelaren</h1>
                </div>
            </div>
            <div class="flex flex-wrap h-full">
                <div class="table">
                    <div class="dealer-table-header">
                        <div class="actions">
                            <div class="col-left">
                                <div class="filter-on-name">
                                    <div class="input">
                                        <input v-model="searchKeyDebouncer" type="text" class="searcher" placeholder="Zoeken...">
                                        <i class="fas fa-search search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-info">
                            <div class="item name"><p>Naam</p></div>
                            <div class="item email"><p>E-mailadres</p></div>
                            <div class="item phonenumber"><p>Telefoonnummer</p></div>
                            <div class="item companyname"><p>Bedrijfsnaam</p></div>
                            <div class="item kvknumber"><p>KVK nummer</p></div>
                            <div class="item status"><p>Status</p></div>
                            <div class="item actions"><p>Acties</p></div>
                        </div>
                    </div>
                    <div class="table-body">
                        <dm-dealer v-for="dealer in getDealers" :key="dealer.id" :dealer="dealer"></dm-dealer>
                    </div>
                    <div class="table-footer">
                        <div class="pager">
                            <div @click="_handlePagerClick(1)" v-if="(page !== 1)" class="pager-item">
                                <i class="pager-counter fas fa-angle-double-left"></i>
                            </div>
                            <div class="pager-item" :class="[ this.page == page ? 'active' : 'inactive' ]" :key="index" v-for="page, index in getPager">
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
    </section>
</template>