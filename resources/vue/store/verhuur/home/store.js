import { createStore } from "vuex";
import axios from "axios";

export default createStore({
    state: {
        filters: [],
        activeFilters: [],
        vehicles: [],
    },

    getters: {
        getFilters(state) {
            return state.filters;
        },

        getActiveFilters(state) {
            return state.activeFilters;
        },

        getVehicles(state) {
            if (state.activeFilters.length > 0) {
                return state.vehicles.filter(v => {
                    return v.tags.some((t) => {
                        return state.activeFilters.some((af) => af.name === t.name);
                    });
                })
            }

            return state.vehicles;
        },
    },

    mutations: {
        SET_VEHICLES(state, vehicles) {
            state.vehicles = vehicles;
        },

        SET_FILTERS(state, filters) {
            state.filters = filters;
        },

        SET_ACTIVE_FILTERS(state, filters) {
            state.activeFilters = filters;
        },

        ADD_ACTIVE_FILTER(state, filter) {
            if (!state.activeFilters.some((f) => f.id === filter.id)) {
                state.activeFilters.push(filter);
            }
        },

        REMOVE_ACTIVE_FILTER(state, filter) {
            state.activeFilters = state.activeFilters.filter(f => f.id !== filter.id);
        },
    },

    actions: {
        async fetchVehicles({ commit }) {
            await axios.get('/api/v2/vehicles')
                .then((response) => {
                    commit("SET_VEHICLES", response.data.vehicles);
                })
        },

        async fetchFilters({ commit }) {
            await axios.get('/api/v2/filters')
                .then((response) => {
                    commit("SET_FILTERS", response.data.filters);
                });
        },

        async removeAllFilters({ commit }) {
            commit("SET_ACTIVE_FILTERS", []);
        }
    }
})
