import _, { filter, first } from 'lodash';
import { fetchVehicles, generateVehicleCard } from '../helpers/vehicleCard';

const canvas = document.querySelector('#svm-canvas');
var initted = false;

const _handleCanvasListener = (targetNode) => {
    const config = { childList: true, subtree: true };
    const callback = (mutationsList, observer) => {
        for (let mutation of mutationsList) {
            if (mutation.type === 'childList' && (mutation.target.id === "svm-canvas" || mutation.target.id === "resultsTable") && !initted) {
                if (document.body.classList.contains("page-voorraad")) {
                    initNewContent(targetNode, "/voorraad/machine");
                } else if (document.body.classList.contains("page-dealer-voorraad")) {
                    initNewContent(targetNode, "/dealer/voorraad/machine");
                }
                _handleFiltersListener();
                _handlePagerListener();
                _handleSortFiltersListener();
                _handleRemoveAllFiltersButtonListener();
                _handlePriceFilterListener();
                initted = true;
            }
        }
    };

    const observer = new MutationObserver(callback);
    observer.observe(targetNode, config);
}

const initNewContent = (canvas, detailPage) => {
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
        stockResults.appendChild(generateVehicleCard(vehicle, detailPage));
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
    const filtersRemoveAll = document.querySelectorAll("#refineActiveFilters .refineActiveFilter");

    if (_.isEmpty(filtersRemoveAll)) {
        return;
    }

    _.forEach([...filtersRemoveAll], (filter) => {
        filter.addEventListener("click", () => {
            initted = false;
        })
    })
}

const _handleSortFiltersListener = () => {
    const selectorOptions = document.querySelectorAll("#svm-canvas .navigation #sort_resultsSelectBoxItOptions li.selectboxit-option");

    _.forEach([...selectorOptions], (option) => {
        option.addEventListener("click", () => {
            initted = false;
        })
    })
}

const _handlePagerListener = () => {
    const pagers = document.querySelectorAll("#svm-canvas #pageContent #stock .navigation .pager a.page");

    _.forEach([...pagers], (pager) => {
        pager.addEventListener("click", () => {
            initted = false;
        })
    });
}

const _handlePriceFilterListener = () => {
    const priceMin = document.querySelectorAll("#svm-canvas #refine .svmRefineOption .field-min");
    const priceMax = document.querySelectorAll("#svm-canvas #refine .svmRefineOption .field-max");

    _.forEach([...priceMin, ...priceMax], (filter) => {
        filter.addEventListener("click", (filter) => {
            initted = false;
        })
    })
}

if (canvas && document.body.classList.contains("page-voorraad") || document.body.classList.contains("page-dealer-voorraad")) {
    _handleCanvasListener(canvas);
}