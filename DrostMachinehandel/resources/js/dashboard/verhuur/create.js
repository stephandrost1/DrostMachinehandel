import axios from "axios";
import _ from "lodash";

const showVehicleDataHtml = document.querySelector("#selected-vehicle-data");
const showVehicleDataLoader = document.querySelector("#vehicle-loader");
const noVehicleSelectedAlert = document.querySelector("#no-vehicle-selected");
const noVehicleThumbnailAlert = document.querySelector("#vehicle-data-thumbnail .no-image-available");

const hideNoVehicleThumbnailAlert = (status) => {
    if (!noVehicleThumbnailAlert.classList.contains("hidden") && status) {
        noVehicleThumbnailAlert.classList.add("hidden")
    } else {
        noVehicleThumbnailAlert.classList.remove("hidden");
    }
}

const noVehicleThumbnailAlertIsHidden = () => {
    return noVehicleThumbnailAlert.classList.contains("hidden");
}

const hideLoadingScreen = (status) => {
    if (!showVehicleDataLoader.classList.contains("hidden") && status) {
        showVehicleDataLoader.classList.add("hidden")
    } else {
        showVehicleDataLoader.classList.remove("hidden");
    }
}

const loadingScreenIsHidden = () => {
    return showVehicleDataLoader.classList.contains("hidden");
}

const hideVehicleDataHtml = (status) => {
    if (!showVehicleDataHtml.classList.contains("hidden") && status) {
        showVehicleDataHtml.classList.add("hidden")
    } else {
        showVehicleDataHtml.classList.remove("hidden");
    }
}

const vehicleDataHtmlIsHidden = () => {
    return showVehicleDataHtml.classList.contains("hidden");
}

const hideNoVehicleSelectedAlert = (status) => {
    if (!noVehicleSelectedAlert.classList.contains("hidden") && status) {
        noVehicleSelectedAlert.classList.add("hidden")
    } else {
        noVehicleSelectedAlert.classList.remove("hidden");
    }
}

const noVehicleSelectedAlertIsHidden = () => {
    return noVehicleSelectedAlert.classList.contains("hidden");
}

function vehicleHasThumbnail() {
    const vehicleThumbnailWrapper = document.querySelector("#vehicle-data-thumbnail");

    return _.isEqual(vehicleThumbnailWrapper.childElementCount, 2);
}

const resetCurrentVehicleData = () => {
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

const _handleCreateVehicleButton = () => {
    const addButton = document.querySelector("#create-rent-vehicle-button");

    addButton.addEventListener("click", () => {
        resetCurrentVehicleData();

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

function _init() {
    _handleCreateVehicleButton();
}

_init();