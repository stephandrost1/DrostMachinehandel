import _, { filter, first } from 'lodash';
import { fetchVehicles, generateVehicleCard } from '../helpers/vehicleCard';

const canvas = document.querySelector('#svm-canvas');
var initted = false;

const _handleCanvasListener = (targetNode) => {
    const config = { childList: true, subtree: true };
    const callback = (mutationsList, observer) => {
        for (let mutation of mutationsList) {
            if (mutation.type === 'childList' && (mutation.target.id === "svm-canvas" || mutation.target.id === "resultsTable") && !initted) {
                initNewContent(targetNode);
                _handleFiltersListener();
                _handlePagerListener();
                _handleSortFiltersListener();
                _handleRemoveAllFiltersButtonListener();
                initted = true;
            }
        }
    };

    const observer = new MutationObserver(callback);
    observer.observe(targetNode, config);
}

const initNewContent = (canvas) => {
    const stockResults = canvas.querySelector('div#resultsTable');

    if (!stockResults) {
        setTimeout((canvas) => {
            initNewContent(canvas);
        }, 100)
    }

    const vehicles = fetchVehicles();

    const nextIcon = document.querySelector("#svm-canvas #stockContainer .navigation .pager .next");
    const lastIcon = document.querySelector("#svm-canvas #stockContainer .navigation .pager .last");
    const prevIcon = document.querySelector("#svm-canvas #stockContainer .navigation .pager .previous");
    const firstIcon = document.querySelector("#svm-canvas #stockContainer .navigation .pager .first");


    const newNextIcon = document.createElement("i")
    newNextIcon.classList = "fas fa-angle-right"

    const newLastIcon = document.createElement("i")
    newLastIcon.classList = "fas fa-angle-double-right"

    const newPreviousIcon = document.createElement("i")
    newPreviousIcon.classList = "fas fa-angle-left"

    const newFirstIcon = document.createElement("i")
    newFirstIcon.classList = "fas fa-angle-double-left"

    if (nextIcon) {
        nextIcon.replaceChildren(newNextIcon);
    }

    if (lastIcon) {
        lastIcon.replaceChildren(newLastIcon);
    }

    if (prevIcon) {
        prevIcon.replaceChildren(newPreviousIcon);
    }

    if (firstIcon) {
        firstIcon.replaceChildren(newFirstIcon);
    }

    stockResults.replaceChildren([]);

    _.forEach(vehicles, (vehicle) => {
        stockResults.appendChild(generateVehicleCard(vehicle));
    });
}

const _handleFiltersListener = () => {
    const filtersAdd = document.querySelectorAll(".refineAdd");
    const filtersRemove = document.querySelectorAll(".refineRemove");

    if (!filtersAdd && !filtersRemove) {
        return;
    }

    _.forEach([...filtersAdd, ...filtersRemove], (filter) => {
        filter.addEventListener("click", () => {
            initted = false;
        })
    })
}

const _handleRemoveAllFiltersButtonListener = () => {
    const filtersRemoveAll = document.querySelector("#refineActiveFilters .refineActiveFilter .removeAll");

    if (!filtersRemoveAll) {
        return;
    }

    filtersRemoveAll.addEventListener("click", () => {
        initted = false;
        console.log("click remove all filters")
    })
}

const _handleSortFiltersListener = () => {
    const selectorOptions = document.querySelector("#svm-canvas .navigation #sort_results");

    selectorOptions.addEventListener("change", () => {
        initted = false;
    })
}

const _handlePagerListener = () => {
    const pagers = document.querySelectorAll("#svm-canvas #pageContent #stock .navigation .pager a.page");

    console.log("pager on click")

    _.forEach([...pagers], (pager) => {
        pager.addEventListener("click", () => {
            initted = false;
        })
    });
}

if (canvas && document.body.classList.contains("page-voorraad")) {
    _handleCanvasListener(canvas);
}