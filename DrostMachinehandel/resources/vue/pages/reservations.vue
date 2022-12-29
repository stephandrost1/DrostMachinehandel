<script>
import axios from 'axios'
import reservation from '../components/reservations/reservation.vue'
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


<template>
    <div class="vue-reservations table">
        <div class="dealer-table-header">
            <div class="actions">
                <div class="col-left">
                    <div class="filter-on-name">
                        <div class="input">
                            <input v-model="searchQuery" type="text" class="searcher" placeholder="Zoeken...">
                            <i class="fas fa-search search-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-info">
                <div class="item name">
                    <p>Naam</p>
                </div>
                <div class="item email">
                    <p>E-mailadres</p>
                </div>
                <div class="item phonenumber">
                    <p>Afstand</p>
                </div>
                <div class="item companyname">
                    <p>Machine</p>
                </div>
                <div class="item kvknumber">
                    <p>Tijd</p>
                </div>
                <div class="item actions">
                    <p>Acties</p>
                </div>
            </div>
        </div>
        <div class="table-body">
            <dm-reservation v-for="reservation in reservations" :key="reservation.id"
                :reservation="reservation"></dm-reservation>
        </div>
        <div class="table-footer">
            <div class="pager">
                <div @click="_handlePagerClick(1)" v-if="(currentPage !== 1)" class="pager-item">
                    <i class="pager-counter fas fa-angle-double-left"></i>
                </div>
                <div class="pager-item" :class="[this.currentPage == page ? 'active' : 'inactive']" :key="index"
                    v-for="page, index in getPager">
                    <div class="pager-counter" @click="_handlePagerClick(page)">{{ page }}</div>
                </div>
                <div @click="_handlePagerClick(getPages)" v-if="(currentPage !== getPages)" class="pager-item">
                    <i class="pager-counter fas fa-angle-double-right"></i>
                </div>
            </div>
        </div>
    </div>
</template>