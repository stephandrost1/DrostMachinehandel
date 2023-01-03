import { createStore } from "vuex";
import axios from "axios";

export default createStore({
    state: {
        admin: [],
    },

    getters: {
        getAdmin(state) {
            return state.admin;
        }
    },

    mutations: {
        SET_ADMIN(state, admin) {
            state.admin = admin;
        },
    },

    actions: {
        fetchAdmin({ commit }) {
            axios.get(`/api/v1/user`)
                .then((response) => {
                    commit("SET_ADMIN", response.data.user);
                })
        }
    }
});