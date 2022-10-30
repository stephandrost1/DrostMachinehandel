import axios from "axios";
import _ from "lodash";

const selectVehicleButton = document.querySelector("#select-rent-vehicle-button");
const selectVehicleDropdown = document.querySelector("#select-rent-vehicle-dropdown");
const selectVehicleToggler = document.querySelector("#select-rent-vehicle-toggler");
const selectVehicleOptions = document.querySelectorAll(".select-rent-vehicle-option");
const selectedVehicle = document.querySelector("#selected-vehicle");

const showVehicleDataHtml = document.querySelector("#selected-vehicle-data");
const showVehicleDataLoader = document.querySelector("#vehicle-loader");
const noVehicleSelectedAlert = document.querySelector("#no-vehicle-selected");

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
            updateVehicleHtml(response.data.vehicle);

            if (showVehicleDataHtml.classList.contains("hidden")) {
                showVehicleDataHtml.classList.remove("hidden");
            }

            if (!showVehicleDataLoader.classList.contains("hidden")) {
                showVehicleDataLoader.classList.add("hidden");
            }
        }
    })
}

async function updateVehicleHtml(vehicle) {
    const vehicleWrapper = document.querySelector("#selected-vehicle");
    vehicleWrapper.dataset.vehicleId = vehicle.id;

    const vehicleName = document.querySelector("#selected-vehicle-name");
    vehicleName.value = vehicle.vehicle_name;

    const vehicleDescription = document.querySelector("#selected-vehicle-description");
    vehicleDescription.value = vehicle.vehicle_description;

    const vehiclePricePerDay = document.querySelector("#selected-vehicle-price-per-day");
    vehiclePricePerDay.value = vehicle.price_per_day;

    const vehiclePricePerWeek = document.querySelector("#selected-vehicle-price-per-week");
    vehiclePricePerWeek.value = vehicle.price_per_week;
}

function _handleSelectVehicleButton() {
    selectVehicleButton.addEventListener("click", () => {
        if (!selectedVehicle.dataset.vehicleId) {
            return;
        }

        if (!noVehicleSelectedAlert.classList.contains("hidden")) {
            noVehicleSelectedAlert.classList.add("hidden");
        }

        if (!showVehicleDataHtml.classList.contains("hidden")) {
            showVehicleDataHtml.classList.add("hidden");
        }

        if (showVehicleDataLoader.classList.contains("hidden")) {
            showVehicleDataLoader.classList.remove("hidden");
        }

        fetchVehicleById(selectedVehicle.dataset.vehicleId);
    })
}

function _handleFilterSelectListToggler() {
    const filters = document.querySelectorAll(".vehicle-filter-option-list");

    _.forEach([...filters], (filter) => {
        filter.addEventListener("click", (event) => {
            if (event.target.classList.contains("no-toggle")) {
                return;
            }

            const list = filter.querySelector(".selectable-list");
            list.classList.toggle("hidden");
        })
    })
}

function _init() {
    _handleSelectRentVehicleOption();
    _handleSelectVehicleDropdown();
    _handleSelectVehicleButton();
    _handleFilterSelectListToggler();
}

_init();