import axios from "axios";
import _ from "lodash";
import popupS from "popups";

const selectVehicleButton = document.querySelector("#select-rent-vehicle-button");
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
const deleteSelectedVehicleButton = document.querySelector("#delete-selected-vehicle");
const deleteVehiclePopup = document.querySelector(".popup-confirmation-box");
const popupAcceptButton = document.querySelector(".popup-confirmation-box #popup-accept-button");
const popupCancelButton = document.querySelector(".popup-confirmation-box #popup-cancel-button");

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

function getAllFilterValues(parent) {
    if (!_.isElement(parent)) {
        return;
    }

    const children = parent.querySelectorAll(".option");

    return _.map(children, (child) => {
        return child.querySelector(".option-label").id.toLowerCase()
    })
}

function _handleNewFilterActions() {
    acceptNewFilterButton.addEventListener("click", (event) => {
        addNewOptionItem.classList.add("hidden");
        const filtersList = event.target.closest(".list-wrapper").querySelector("#list-of-filters");

        if (newFilterInput.value == "" || _.includes(getAllFilterValues(filtersList), newFilterInput.value.toLowerCase())) {
            newFilterInput.value = "";
            return;
        }

        const container = document.createElement("div");
        container.classList = "option no-toggle flex gap-2 items-center";

        const input = document.createElement("input");
        input.classList = "no-toggle";
        input.type = "checkbox";
        input.id = "new-filter"

        const label = document.createElement("label");
        label.classList = "no-toggle option-label";
        label.id = newFilterInput.value;
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
    if (_.isNull(id)) {
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

function generateVehicleThumbnail(image, file, parent) {
    const container = document.createElement("div");
    container.classList = "vehicle-thumbnail-container"

    const imageElement = document.createElement("img");
    imageElement.classList = "rounded-lg w-full h-full object-cover";
    if (!_.isEmpty(image)) {
        imageElement.src = `/${image.image_location}${image.image_name}.${image.image_type}`;
    } else {
        imageElement.src = URL.createObjectURL(file);
    }

    const imageActions = document.createElement("div");
    imageActions.classList = "image-actions absolute duration-200 flex justify-center items-center w-full h-full top-0";

    const deleteImageWrapper = document.createElement("div");
    deleteImageWrapper.classList = "delete-image";

    deleteImageWrapper.addEventListener("click", () => {
        parent.removeChild(container);
        const noImageAlert = document.querySelector(".no-image-available")
        noImageAlert.classList.remove("hidden");
    })

    const deleteIcon = document.createElement("i");
    deleteIcon.classList = "fas fa-trash text-black text-xl";

    deleteImageWrapper.append(deleteIcon);
    imageActions.append(deleteImageWrapper);

    container.append(imageElement);
    container.append(imageActions);

    return container;
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

    const swiperWrapper = document.querySelector(".vehicle-swiper-wrapper");
    const vehicleThumbnail = document.querySelector("#vehicle-data-thumbnail");
    const noImagePlaceholder = vehicleThumbnail.querySelector(".no-image-available");

    swiperWrapper.replaceChildren([]);
    vehicleThumbnail.replaceChildren(noImagePlaceholder);

    _.forEach((vehicle.images), (image, index) => {
        if (index === 0) {
            vehicleThumbnail.append(generateVehicleThumbnail(image, null, vehicleThumbnail));
        } else {
            swiperWrapper.append(generateVehicleSliderImage(image, null, swiperWrapper));
        }
    })

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

function generateVehicleSliderImage(image, file, swiperWrapper) {
    const swiperSlide = document.createElement("div");
    swiperSlide.classList = "image w-full h-full relative";

    const slideImage = document.createElement("img");
    slideImage.classList = "rounded-lg w-full h-full object-cover aspect-square";
    if (!_.isEmpty(image)) {
        slideImage.src = `/${image.image_location}${image.image_name}.${image.image_type}`;
    } else {
        slideImage.src = URL.createObjectURL(file);
    }
    slideImage.width = "400";
    slideImage.height = "400";

    const imageActions = document.createElement("div");
    imageActions.classList = "image-actions absolute duration-200 flex justify-center items-center w-full h-full top-0";

    const deleteImageAction = document.createElement("div");
    deleteImageAction.classList = "delete-image";
    deleteImageAction.addEventListener("click", () => {
        swiperWrapper.removeChild(deleteImageAction.closest(".image"));
    })

    const deleteIcon = document.createElement("i");
    deleteIcon.classList = "fas fa-trash text-black text-xl";

    deleteImageAction.append(deleteIcon);
    imageActions.append(deleteImageAction);

    swiperSlide.append(slideImage);
    swiperSlide.append(imageActions);

    return swiperSlide;
}

function vehicleHasThumbnail() {
    const vehicleThumbnailWrapper = document.querySelector("#vehicle-data-thumbnail");

    return _.isEqual(vehicleThumbnailWrapper.childElementCount, 2);
}

function _handleVehicleImagesDragAndDropZone() {
    const dropzoneInput = document.getElementById("dropzone-file");
    const swiperWrapper = document.querySelector(".vehicle-swiper-wrapper");
    const vehicleThumbnail = document.querySelector("#vehicle-data-thumbnail")

    dropzoneInput.addEventListener("change", (event) => {
        _.forEach(event.target.files, (file, index) => {
            if (index == 0 && !vehicleHasThumbnail()) {
                vehicleThumbnail.append(generateVehicleThumbnail([], file, vehicleThumbnail));
                vehicleThumbnail.querySelector(".no-image-available").classList.add("hidden");
            }

            swiperWrapper.append(generateVehicleSliderImage([], file, swiperWrapper));
        })
    });
}

function _handlePopupAcceptButton(popup, vehicleId) {
    popup.classList.add("hidden");

    axios.delete(`/dashboard/vehicle/${vehicleId}/delete`);

    if (!showVehicleDataHtml.classList.contains("hidden")) {
        showVehicleDataHtml.classList.add("hidden");
    }

    if (noVehicleSelectedAlert.classList.contains("hidden")) {
        noVehicleSelectedAlert.classList.remove("hidden");
    }

    window.location.reload();
}

function _handlePopupCancelButton(popup) {
    popup.classList.add("hidden");
}

function _handleDeleteVehicleButton() {
    deleteSelectedVehicleButton.addEventListener("click", () => {
        deleteVehiclePopup.classList.remove("hidden");
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

function _handlePopupButtons() {
    popupAcceptButton.addEventListener("click", () => {
        const selectedVehicleId = document.querySelector("#selected-vehicle").dataset.vehicleId;
        _handlePopupAcceptButton(deleteVehiclePopup, selectedVehicleId)
    })

    popupCancelButton.addEventListener("click", _handlePopupCancelButton(deleteVehiclePopup));
}

function _init() {
    _handleSelectRentVehicleOption();
    _handleSelectVehicleButton();
    _handleAddVehicleSpecButton();
    _handleFilterSelectListToggler();
    _handleAddNewFilterButton();
    _handleNewFilterActions();
    _handleDeleteVehicleButton();
    _handlePopupButtons();
    _handleVehicleImagesDragAndDropZone();
}

_init();