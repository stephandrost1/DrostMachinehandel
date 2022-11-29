import { createStore } from "vuex";
import axios from "axios";

export default createStore({
    state: {
        vehicleFilters: [],
        vehicles: [],
        selectedVehicle: null,
    },

    getters: {
        getFilters(state) {
            return state.vehicleFilters;
        },

        getVehicles(state) {
            return state.vehicles;
        },

        getSelectedVehicle(state) {
            return state.selectedVehicle;
        }
    },

    mutations: {
        SET_VEHICLES(state, vehicles) {
            state.vehicles = vehicles;
        },

        SET_SELECTED_VEHICLE(state, vehicle) {
            state.selectedVehicle = vehicle;
        },

        SET_FILTERS(state, filters) {
            state.filters = filters;
        },

        ADD_FILTER(state, filter) {
            if (state.vehicleFilters.filter(f => f.filter_name.toLowerCase() == filter.filter_name.toLowerCase()).length <= 0) {
                state.vehicleFilters.push({
                    ...filter,
                    options: filter.options.map(option => {
                        return {
                            ...option,
                            isActive: false,
                        }
                    })
                });
            }
        },
    },

    actions: {
        async fetchVehicles({ commit }) {
            axios.get('/api/v1/vehicles')
                .then((response) => {
                    commit("SET_VEHICLES", response.data.vehicles);
                })
        },

        async fetchVehicleById({ commit }, id) {
            axios.get(`/api/v1/vehicle/${id}`)
                .then((response) => {
                    commit("SET_SELECTED_VEHICLE", response.data.vehicle);
                })
        },

        async fetchFilters({ commit }) {
            axios.get('/api/v1/filters')
                .then((response) => {
                    response.data.filters.forEach(filter => {
                        commit("ADD_FILTER", filter);
                    });
                });
        }
    }
})
