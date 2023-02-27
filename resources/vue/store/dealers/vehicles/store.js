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
        },

        SET_VEHICLE_DEALER_PRICE(state, dealer_price) {
            state.selectedVehicle = {
                ...state.selectedVehicle,
                dealer_price
            };
        },

        UPDATE_VEHICLE_DEALER_PRICE(state, vehicle) {
            state.vehicles = state.vehicles.map(function (v) {
                if (v.id === vehicle.id) {
                    return vehicle;
                }

                return v;
            })
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
            state.vehicles.forEach((vehicle) => {
                if (vehicle.id === id) {
                    commit("SET_SELECTED_VEHICLE", vehicle);
                }
            });
        },

        async deleteSelectedVehicle({ commit, state }, id) {
            commit("SET_SELECTED_VEHICLE", []);
            commit("SET_VEHICLES", state.vehicles.filter((vehicle) => vehicle.id !== id));
        }
    }
})
