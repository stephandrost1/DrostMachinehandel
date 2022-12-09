import { createStore } from "vuex";
import axios from "axios";

export default createStore({
    state: {
        dealers: [],
        pages: 1,
    },

    getters: {
        getDealers(state) {
            return state.dealers;
        },

        getPages(state) {
            return state.pages;
        }
    },

    mutations: {
        SET_DEALERS(state, dealers) {
            state.dealers = dealers;
        },

        SET_PAGES(state, pages) {
            state.pages = pages;
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
        async fetchDealers({ commit }, page) {
            await axios.get(`/api/v1/dealers/page/${page}`)
                .then((response) => {
                    commit("SET_DEALERS", response.data.dealers);
                    commit("SET_PAGES", response.data.pages);
                })
        },
    }
})
