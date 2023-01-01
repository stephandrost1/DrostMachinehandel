import { createStore } from "vuex";
import axios from "axios";

export default createStore({
    state: {
        dealer: [],
    },

    getters: {
        getDealer(state) {
            return state.dealer;
        }
    },

    mutations: {
        SET_DEALER(state, dealer) {
            state.dealer = dealer;
        },
    },

    actions: {
        fetchDealer({ commit }, dealerId) {
            axios.get(`/api/v1/dealer/${dealerId}`)
                .then((response) => {
                    commit("SET_DEALER", response.data.dealer);
                })
        }
    }
});