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

        getActionsObject(state) {
            let left = [];
            let right = [];
            const sortedObjects = state.selectedVehicle.actions.sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
            sortedObjects.forEach((object, index) => {
                if (index % 2 === 0) {
                    right.push(object);
                } else {
                    left.push(object);
                }
            });
            return { left, right };
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

        ADD_SELECTED_VEHICLE_ACTION(state, action) {
            state.selectedVehicle.actions.push(action);
        }
    },

    actions: {
        async fetchVehicles({ commit }) {
            await axios.get(`/api/v1/vehicles/maintenance`)
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

        addNewAction({ commit }, action) {
            commit("ADD_SELECTED_VEHICLE_ACTION", action);
        }
    }
})
