import axios from "axios";
import _ from "lodash";

const selectVehicleButton = document.querySelector("#select-rent-vehicle-button");
const selectVehicleDropdown = document.querySelector("#select-rent-vehicle-dropdown");
const selectVehicleToggler = document.querySelector("#select-rent-vehicle-toggler");
const selectVehicleOptions = document.querySelectorAll(".select-rent-vehicle-option");
const selectedVehicle = document.querySelector("#selected-vehicle");
const selectedVehicleSpecsContainer = document.querySelector("#vehicle-specs-container");
const selectedVehicleSpecsAdd = document.querySelector("#add-specs");
const addNewFilter = document.querySelector("#add-new-filter");
const addNewOptionItem = document.querySelector("#add-new-option-item");
const acceptNewFilterButton = document.querySelector("#accept-new-filter");
const rejectNewFilterButton = document.querySelector("#reject-new-filter");
const newFilterInput = document.querySelector("#newFilter-input");
const listOfFilters = document.querySelector("#list-of-filters");

const showVehicleDataHtml = document.querySelector("#selected-vehicle-data");
const showVehicleDataLoader = document.querySelector("#vehicle-loader");
const noVehicleSelectedAlert = document.querySelector("#no-vehicle-selected");

function generateVehicleSpecBlock(name, value) {
    const selectedVehicleSpecs = document.querySelectorAll("#vehicle-specs-container .specs-row");

    const container = document.createElement("div")
    container.classList = "specs-row flex gap-2 w-full items-center"

    const columnOne = document.createElement("div")
    columnOne.classList = "col-1 w-5/12"

    const inputColumnOne = document.createElement("input")
    inputColumnOne.name = "spec_" + (selectedVehicleSpecs.length + 1) + "_q";
    inputColumnOne.id = "spec_" + (selectedVehicleSpecs.length + 1) + "_q";
    inputColumnOne.classList = "w-full h-12 rounded-lg border-2 border-primary pl-2";
    if (value) {
        inputColumnOne.value = name;
    } else {
        inputColumnOne.placeholder = "Naam";
    }

    columnOne.append(inputColumnOne);

    const columnTwo = document.createElement("div")
    columnTwo.classList = "col-2 w-5/12"

    const inputColumnTwo = document.createElement("input")
    inputColumnTwo.name = "spec_" + (selectedVehicleSpecs.length + 1) + "_a";
    inputColumnTwo.id = "spec_" + (selectedVehicleSpecs.length + 1) + "_a";
    inputColumnTwo.classList = "w-full h-12 rounded-lg border-2 border-primary pl-2";
    if (value) {
        inputColumnTwo.value = value;
    } else {
        inputColumnTwo.placeholder = "Waarde";
    }

    columnTwo.append(inputColumnTwo);

    const removeSpecContainer = document.createElement("div");
    removeSpecContainer.classList = "col-3 w-2/12 flex items-center justify-center";

    removeSpecContainer.addEventListener("click", () => {
        selectedVehicleSpecsContainer.removeChild(container);
    })

    const trashIcon = document.createElement("i");
    trashIcon.classList = "fas fa-trash text-lg";

    removeSpecContainer.append(trashIcon);

    container.append(columnOne);
    container.append(columnTwo);
    container.append(removeSpecContainer);

    selectedVehicleSpecsContainer.append(container);

}

function _handleNewFilterActions() {
    acceptNewFilterButton.addEventListener("click", () => {
        addNewOptionItem.classList.add("hidden");

        if (newFilterInput.value == "") {
            return;
        }

        const container = document.createElement("div");
        container.classList = "option no-toggle flex gap-2 items-center";

        const input = document.createElement("input");
        input.classList = "no-toggle";
        input.type = "checkbox";
        input.id = "new-filter"

        const label = document.createElement("label");
        label.classList = "no-toggle";
        label.id = "new-filter";
        label.innerHTML = newFilterInput.value;
        newFilterInput.value = "";

        container.append(input);
        container.append(label);
        listOfFilters.append(container);
    })

    rejectNewFilterButton.addEventListener("click", () => {
        addNewOptionItem.classList.add("hidden");
        newFilterInput.value = "";
    })
}

function _handleAddNewFilterButton() {
    addNewFilter.addEventListener("click", () => {
        addNewOptionItem.classList.remove("hidden");
    })
}

function _handleAddVehicleSpecButton() {
    selectedVehicleSpecsAdd.addEventListener("click", () => {
        generateVehicleSpecBlock();
    })
}

function _handleSelectVehicleDropdown() {
    selectVehicleToggler.addEventListener("click", () => {
        selectVehicleDropdown.classList.toggle("h-0")
    })
}

function unselectEveryMachineOption() {
    _.forEach([...selectVehicleOptions], (vehicle) => {
        vehicle.classList.remove("bg-primary");
        vehicle.classList.remove("text-white");
        vehicle.classList.add("text-primary");
    })
}

function _handleSelectRentVehicleOption() {
    _.forEach([...selectVehicleOptions], (vehicle) => {
        vehicle.addEventListener("click", (event) => {
            unselectEveryMachineOption();
            selectedVehicle.innerHTML = event.target.children[0].innerHTML;
            selectedVehicle.dataset.vehicleId = event.target.children[0].id;
            event.target.classList.add("bg-primary")
            event.target.classList.add("text-white")
            event.target.classList.remove("text-primary")
        })
    })
}

function fetchVehicleById(id) {
    if (_.isEmpty(id)) {
        return;
    }

    axios.get("/api/v1/vehicle/" + id).then((response) => {
        if (response.data.results) {
            console.log(response.data.vehicle)
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

    selectedVehicleSpecsContainer.replaceChildren([]);

    _.forEach(vehicle.details, (detail) => {
        generateVehicleSpecBlock(detail.detail_name, detail.detail_value);
    })
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

// noVehicleSelectedAlert.classList.add("hidden");
// showVehicleDataHtml.classList.remove("hidden");
// fetchVehicleById(1);

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
    _handleAddVehicleSpecButton();
    _handleFilterSelectListToggler();
    _handleAddNewFilterButton();
    _handleNewFilterActions();
}

_init();