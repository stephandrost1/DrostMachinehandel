import { createStore } from "vuex";
import axios from "axios";
import _ from "lodash";

export default createStore({
    state: {
        vehicles: [],
        allVehicles: [],
        selectedVehicle: [],
    },

    getters: {
        getVehicles(state) {
            return state.vehicles;
        },

        getActionsObject(state) {
            let left = [];
            let right = [];
            const vehicleActions = state.selectedVehicle.actions ?? [];
            const sortedObjects = vehicleActions.sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
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

        SET_ALL_VEHICLES(state, vehicles) {
            state.allVehicles = vehicles;
        },

        SET_SELECTED_VEHICLE(state, vehicle) {
            state.selectedVehicle = vehicle;
        },

        ADD_SELECTED_VEHICLE_ACTION(state, action) {
            state.selectedVehicle.actions.push(action);
        },

        ADD_VEHICLE(state, vehicle) {
            state.vehicles.push(vehicle);
        },

        REMOVE_SELECTED_VEHICLE_ACTION(state, actionId) {
            state.selectedVehicle.actions = state.selectedVehicle.actions.filter((action) => action.id !== actionId);
        },

        REMOVE_VEHICLE(state, vehicleId) {
            state.vehicles = state.vehicles.filter((v) => v.id !== vehicleId);
        },

        EDIT_SELECTED_VEHICLE_ACTION(state, action) {
            state.selectedVehicle.actions = state.selectedVehicle.actions.map((a) => {
                if (a.id === action.id) {
                    return action;
                }

                return a;
            })
        },

        UPDATE_VEHICLE_NAME(state, vehicle) {
            console.log("vehicleee")
            console.log(vehicle)
            state.vehicles = state.vehicles.map(v => {
                if (v.id == vehicle.id) {
                    return vehicle;
                }

                return v;
            })
        }
    },

    actions: {
        async fetchVehicles({ commit }) {
            await axios.get(`/api/v1/vehicles/maintenance`)
                .then((response) => {
                    commit("SET_VEHICLES", response.data.vehicles);
                    commit("SET_ALL_VEHICLES", response.data.vehicles);
                })
        },

        async fetchVehicleById({ commit, state }, id) {
            state.vehicles.forEach((vehicle) => {
                if (vehicle.id === id) {
                    commit("SET_SELECTED_VEHICLE", vehicle);
                }
            });
        },

        async filterVehiclesByQuery({ commit, state }, query) {
            const queryRegex = new RegExp(query, "i");
            const vehicles = state.allVehicles.filter((vehicle) => {
                return (
                    vehicle.vehicle_name.match(queryRegex) ||
                    vehicle.mark.match(queryRegex) ||
                    vehicle.type.match(queryRegex) ||
                    vehicle.serial_number.match(queryRegex) ||
                    vehicle.reference_number.match(queryRegex)
                );
            });

            commit("SET_VEHICLES", vehicles);
        },

        addNewAction({ commit }, action) {
            commit("ADD_SELECTED_VEHICLE_ACTION", action);
        },

        removeAction({ commit }, actionId) {
            commit("REMOVE_SELECTED_VEHICLE_ACTION", actionId);
        },

        editAction({ commit }, action) {
            commit("EDIT_SELECTED_VEHICLE_ACTION", action);
        },

        addNewVehicle({ commit, state }, vehicle) {
            if (!_.isEmpty(state.selectedVehicle) | _.isNull(state.selectedVehicle)) {
                axios.patch(`/api/v1/vehicles/maintenance/${this.state.selectedVehicle.id}`, vehicle)
                    .then((response) => {
                        commit("UPDATE_VEHICLE_NAME", { ...vehicle, actions: this.state.selectedVehicle.actions, id: this.state.selectedVehicle.id });
                        commit("SET_SELECTED_VEHICLE", { ...vehicle, actions: this.state.selectedVehicle.actions });
                        this.$toast.success(response.data.message);
                    }).catch((error) => {
                        this.$toast.error(error.response.data.message);
                    })
            } else {
                axios.post("/api/v1/vehicles/maintenance", vehicle)
                    .then((response) => {
                        commit("ADD_VEHICLE", { ...vehicle, id: response.data.vehicle_id, actions: [] });
                        commit("SET_SELECTED_VEHICLE", { ...vehicle, id: response.data.vehicle_id, actions: [] });
                        this.$toast.success(response.data.message);
                    }).catch((error) => {
                        this.$toast.error(error.response.data.message);
                    })
            }
        },

        deleteVehicle({ commit }, vehicleId) {
            axios.delete(`/api/v1/vehicles/maintenance/${vehicleId}`)
                .then((response) => {
                    this.$toast.success(response.data.message);
                }).catch((error) => {
                    this.$toast.error(error.response.data.message);
                })

            commit("REMOVE_VEHICLE", vehicleId);
            commit("SET_SELECTED_VEHICLE", []);
        }
    }
})
