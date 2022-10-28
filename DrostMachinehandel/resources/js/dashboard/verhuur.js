import _ from "lodash";

const selectVehicleButton = document.querySelector("#select-rent-vehicle-button");
const selectVehicleDropdown = document.querySelector("#select-rent-vehicle-dropdown");
const selectVehicleToggler = document.querySelector("#select-rent-vehicle-toggler");
const selectVehicleWrapper = document.querySelector("#select-rent-vehicle-wrapper");
const selectVehicleOptions = document.querySelectorAll(".select-rent-vehicle-option");
const selectedVehicle = document.querySelector("#selected-vehicle");

function selectVehicle() {
    selectVehicleToggler.addEventListener("click", () => {
        selectVehicleDropdown.classList.toggle("h-0")
    })
}

function _handleSelectRentVehicleOption() {
    _.forEach([...selectVehicleOptions], (vehicle) => {
        vehicle.addEventListener("click", (event) => {
            selectedVehicle.innerHTML = event.target.innerHTML
        })
    })
}

_handleSelectRentVehicleOption();
selectVehicle();