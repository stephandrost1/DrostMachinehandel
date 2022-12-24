import { createStore } from "vuex";
import axios from "axios";

export default createStore({
    state: {
        vehicles: [],
        selectedVehicle: [],
    },

    getters: {
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
        }
    },

    actions: {
        async fetchVehicles({ commit }) {
            await axios.get(`/api/v1/dealer/vehicles`)
                .then((response) => {
                    commit("SET_VEHICLES", response.data.vehicles);
                })
        },

        async fetchVehicleById({ commit, state }, id) {
            console.log(state.vehicles);
            state.vehicles.forEach((vehicle) => {
                if (vehicle.id === id) {
                    commit("SET_SELECTED_VEHICLE", vehicle);
                }
            });
        }
    }
})
