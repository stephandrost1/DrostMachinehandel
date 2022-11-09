import axios from "axios";
import _ from "lodash";


const currentVehicleAction = document.querySelector("#current-vehicle-action").dataset.action;

const getVehicleSpecs = () => {
    const parentElement = document.querySelector("#vehicle-specs-container");
}

const getVehicleTags = () => {
    const parentElement = document.querySelectorAll(".vehicle-filter-option-list #list-of-filters");
}

const _handleSaveNewVehicleButton = () => {
    const vehicleName = document.querySelector("#selected-vehicle-name");
    const vehicleDescription = document.querySelector("#selected-vehicle-description");
    const vehiclePricePerDay = document.querySelector("#selected-vehicle-price-per-day");
    const vehiclePricePerWeek = document.querySelector("#selected-vehicle-price-per-week");
    const vehicleSpecs = getVehicleSpecs();
    const vehicleTags = getVehicleTags();
}

function _init() {
    _handleSaveNewVehicleButton();
}

_init();