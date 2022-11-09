import _ from "lodash";

const currentVehicleAction = document.querySelector("#current-vehicle-action");

const selectVehicleOptions = document.querySelectorAll(".select-rent-vehicle-option");
const selectedVehicle = document.querySelector("#selected-vehicle");

const selectVehicleButton = document.querySelector("#select-rent-vehicle-button");
const addVehicleButton = document.querySelector("#create-rent-vehicle-button");

const showVehicleDataHtml = document.querySelector("#selected-vehicle-data");
const showVehicleDataLoader = document.querySelector("#vehicle-loader");
const noVehicleSelectedAlert = document.querySelector("#no-vehicle-selected");
const noVehicleThumbnailAlert = document.querySelector("#vehicle-data-thumbnail .no-image-available");


function _handleSelectRentVehicleOption(options){
    _.forEach([...options], (vehicle) => {
        vehicle.addEventListener("click", (event) => {
            unselectEveryMachineOption(options);
            selectedVehicle.innerHTML = event.target.children[0].innerHTML;
            selectedVehicle.dataset.vehicleId = event.target.children[0].id;
            event.target.classList.add("bg-primary")
            event.target.classList.add("text-white")
            event.target.classList.remove("text-primary")
        })
    })
}

function unselectEveryMachineOption(options){
    _.forEach([...options], (vehicle) => {
        vehicle.classList.remove("bg-primary");
        vehicle.classList.remove("text-white");
        vehicle.classList.add("text-primary");
    })
}

function _handleCreateVehicleButton(){
    addVehicleButton.addEventListener("click", () => {
        resetCurrentVehicleData();
        toggleAction("create");

        if (noVehicleThumbnailAlertIsHidden()) {
            hideNoVehicleThumbnailAlert(false);
        }

        if (vehicleDataHtmlIsHidden()) {
            hideVehicleDataHtml(false);
        }

        if (!loadingScreenIsHidden()) {
            hideLoadingScreen(true);
        }

        if (!noVehicleSelectedAlertIsHidden()) {
            hideNoVehicleSelectedAlert(true);
        }
    })
}

function toggleAction(action){
    currentVehicleAction.dataset.action = action;
}

function hideNoVehicleThumbnailAlert(status){
    if (!noVehicleThumbnailAlert.classList.contains("hidden") && status) {
        noVehicleThumbnailAlert.classList.add("hidden")
    } else {
        noVehicleThumbnailAlert.classList.remove("hidden");
    }
}

function noVehicleThumbnailAlertIsHidden(){
    return noVehicleThumbnailAlert.classList.contains("hidden");
}

function hideLoadingScreen(status){
    if (!showVehicleDataLoader.classList.contains("hidden") && status) {
        showVehicleDataLoader.classList.add("hidden")
    } else {
        showVehicleDataLoader.classList.remove("hidden");
    }
}

function loadingScreenIsHidden(){
    return showVehicleDataLoader.classList.contains("hidden");
}

function hideVehicleDataHtml(status){
    if (!showVehicleDataHtml.classList.contains("hidden") && status) {
        showVehicleDataHtml.classList.add("hidden")
    } else {
        showVehicleDataHtml.classList.remove("hidden");
    }
}

function vehicleDataHtmlIsHidden(){
    return showVehicleDataHtml.classList.contains("hidden");
}

function hideNoVehicleSelectedAlert(status){
    if (!noVehicleSelectedAlert.classList.contains("hidden") && status) {
        noVehicleSelectedAlert.classList.add("hidden")
    } else {
        noVehicleSelectedAlert.classList.remove("hidden");
    }
}

function noVehicleSelectedAlertIsHidden(){
    return noVehicleSelectedAlert.classList.contains("hidden");
}

function vehicleHasThumbnail() {
    const vehicleThumbnailWrapper = document.querySelector("#vehicle-data-thumbnail");

    return _.isEqual(vehicleThumbnailWrapper.childElementCount, 2);
}

function resetCurrentVehicleData(){
    const vehicleThumbnailContainer = document.querySelector("#selected-vehicle-data #vehicle-data-thumbnail")
    const thumbnailImage = vehicleThumbnailContainer.querySelector(".vehicle-thumbnail-container");

    if (vehicleHasThumbnail()) {
        vehicleThumbnailContainer.removeChild(thumbnailImage);
    }

    const vehicleImagesList = document.querySelector("#selected-vehicle-data .vehicle-swiper-wrapper");
    vehicleImagesList.replaceChildren([]);

    const vehicleName = document.querySelector("#selected-vehicle-name");
    vehicleName.value = "";

    const vehicleDescription = document.querySelector("#selected-vehicle-description");
    vehicleDescription.value = "";

    const vehiclePricePerDay = document.querySelector("#selected-vehicle-price-per-day");
    vehiclePricePerDay.value = "";

    const vehiclePricePerWeek = document.querySelector("#selected-vehicle-price-per-week");
    vehiclePricePerWeek.value = "";

    const vehicleSpecsContainer = document.querySelector("#vehicle-specs-container");
    vehicleSpecsContainer.replaceChildren([]);

    const vehicleTags = document.querySelectorAll(".vehicle-filter-option-list #list-of-filters .option .input-tag");
    _.forEach([...vehicleTags], (tag) => {
        tag.checked = false;
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

        // fetchVehicleById(selectedVehicle.dataset.vehicleId);
        toggleAction("edit");
    })
}


function _init(){
    _handleSelectRentVehicleOption(selectVehicleOptions);
    _handleCreateVehicleButton();
    _handleSelectVehicleButton();
}

_init();
