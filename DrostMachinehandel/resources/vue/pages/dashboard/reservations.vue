<script>
import axios from 'axios'
import reservation from '../../components/reservations/reservation.vue'
import _ from "lodash";

export default {
    components: {
        "dm-reservation": reservation
    },

    data() {
        return {
            reservations: [],
            pages: [],
            currentPage: 1,
            maxPages: [],
            searchQuery: "",
        }
    },

    computed: {
        getPages() {
            return this.maxPages;
        },

        getPager() {
            return this.pages;
        }
    },

    mounted() {
        this.fetchRequests();
    },

    methods: {
        fetchRequests(searchQuery = null) {
            axios.get(`/api/v1/reservations/${this.currentPage}${searchQuery !== null ? `?s=${searchQuery}` : ''}`)
                .then((response) => {
                    this.reservations = response.data.reservations;
                    this.pages = response.data.pages;
                    this.maxPages = response.data.maxPages;
                })
        }
    },

    watch: {
        searchQuery: _.debounce(function (searchQuery) {
            this.page = 1;
            this.fetchRequests(searchQuery)
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
    <div class="py-9 px-1 sm:px-10 min-[1225px]:px-32">
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
        <div class="w-full">
            <table
                class="w-full flex flex-row flex-no-wrap min-[1225px]:bg-white rounded-lg overflow-auto min-[1225px]:overflow-hidden min-[1225px]:shadow-lg my-5">
                <thead class="text-white">
                    <tr v-for="reservation in reservations" :key="reservation.id"
                        class="bg-primary flex flex-col flex-no wrap min-[1225px]:table-row rounded-l-lg min-[1225px]:rounded-none mb-2 min-[1225px]:mb-0">
                        <th class="p-2 min-[1225px]:p-3 text-left">Naam</th>
                        <th class="p-2 min-[1225px]:p-3 text-left">E-mailadres</th>
                        <th class="p-2 min-[1225px]:p-3 text-left">Leverprijs</th>
                        <th class="p-2 min-[1225px]:p-3 text-left">Machine</th>
                        <th class="p-2 min-[1225px]:p-3 text-left">Tijd</th>
                        <th class="p-2 min-[1225px]:p-3 text-left">Acties</th>
                    </tr>
                </thead>
                <tbody class="flex-1 min-[1225px]:flex-none">
                    <dm-reservation v-for="reservation in reservations" :key="reservation.id"
                        :reservation="reservation"></dm-reservation>
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
                    <div :class="[this.page == page ? 'text-white' : 'text-primary']" @click="_handlePagerClick(page)">
                        {{ page }}</div>
                </div>
                <div @click="_handlePagerClick(getPages)" v-if="(page !== getPages)"
                    class="flex justify-center items-center border-2 border-primary w-9 h-9 rounded-xl cursor-pointer">
                    <i class="fas fa-angle-double-right"
                        :class="[this.page == page ? 'text-primary' : 'text-white']"></i>
                </div>
            </div>
        </div>
    </div>
</template>