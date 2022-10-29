import axios from "axios";
import _ from "lodash";

const selectVehicleButton = document.querySelector("#select-rent-vehicle-button");
const selectVehicleDropdown = document.querySelector("#select-rent-vehicle-dropdown");
const selectVehicleToggler = document.querySelector("#select-rent-vehicle-toggler");
const selectVehicleOptions = document.querySelectorAll(".select-rent-vehicle-option");
const selectedVehicle = document.querySelector("#selected-vehicle");
const selectedVehicleData = document.querySelector("#selected-vehicle-data");

function _handleSelectVehicleDropdown() {
    selectVehicleToggler.addEventListener("click", () => {
        selectVehicleDropdown.classList.toggle("h-0")
    })
}

function _handleSelectRentVehicleOption() {
    _.forEach([...selectVehicleOptions], (vehicle) => {
        vehicle.addEventListener("click", (event) => {
            selectedVehicle.innerHTML = event.target.innerHTML;
            selectedVehicle.dataset.vehicleId = event.target.id;
        })
    })
}

function fetchVehicleById(id) {
    if (_.isEmpty(id)) {
        return;
    }

    axios.get("/api/v1/vehicle/" + id).then((response) => {
        if (response.data.results) {
            selectedVehicleData.innerHTML = JSON.stringify(response.data.vehicle);
        }
    })
}

function _handleSelectVehicleButton() {
    selectVehicleButton.addEventListener("click", () => {
        if (!selectedVehicle.dataset.vehicleId) {
            return;
        }

        fetchVehicleById(selectedVehicle.dataset.vehicleId);
    })
}

function _init() {
    _handleSelectRentVehicleOption();
    _handleSelectVehicleDropdown();
    _handleSelectVehicleButton();
}

_init();