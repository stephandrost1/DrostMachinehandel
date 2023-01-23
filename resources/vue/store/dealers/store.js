import { createStore } from "vuex";
import axios from "axios";
import _ from "lodash";

export default createStore({
    state: {
        dealers: [],
        editDealer: [],
        pages: [],
        maxPages: 1,
    },

    getters: {
        getDealers(state) {
            return state.dealers;
        },

        getEditDealer(state) {
            return state.editDealer;
        },

        getPages(state) {
            return state.pages;
        },

        getMaxPages(state) {
            return state.maxPages;
        }
    },

    mutations: {
        SET_DEALERS(state, dealers) {
            state.dealers = dealers;
        },

        SET_EDIT_DEALER(state, dealer) {
            state.editDealer = dealer;
        },

        SET_PAGES(state, pages) {
            state.pages = pages;
        },

        SET_MAX_PAGES(state, maxPages) {
            state.maxPages = maxPages;
        },

        REMOVE_DEALER(state, dealerId) {
            state.dealers = state.dealers.filter((dealer) => dealer.id !== dealerId);
        },

        UPDATE_DEALER(state, dealer) {
            state.dealers = state.dealers.map((d) => {
                if (d.id == dealer.id) {
                    return dealer;
                }

                return d;
            })
        }
    },

    actions: {
        async fetchDealers({ commit }, searchData) {
            await axios.get(`/api/v1/users/page/${searchData.page ? searchData.page : searchData}${searchData.s ? `?s=${searchData.s}` : ''}`)
                .then((response) => {
                    commit("SET_DEALERS", response.data.users);
                    commit("SET_PAGES", response.data.pages);
                    commit("SET_MAX_PAGES", response.data.maxPages);
                })
        },

        async updateDealer({ commit }, dealer) {
            commit("SET_EDIT_DEALER", []);

            if (_.isEmpty(dealer)) {
                return;
            }

            commit("UPDATE_DEALER", dealer);

            axios.patch(`/api/v1/users/dealer/${dealer.id}/update`, dealer)
                .then((response) => {
                    this.$toast.success(response.data.message);
                }).catch((error) => {
                    this.$toast.error(error.response.data.message);
                })
        }
    }
})
