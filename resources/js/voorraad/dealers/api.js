import axios from "axios";

const canvas = document.querySelector('#svm-canvas');
var dealerVehicles = [];
var initted = false;

const fetchVehicles = async () => {
    return axios.get('/api/v1/dealer/vehicles')
        .then((response) => {
            return response.data.vehicles;
        })
}

const getVehicleElements = async () => {
    const canvas = document.getElementById('svm-canvas');
    const form = canvas.querySelector('form.whsearch-form');
    const stockResults = form.querySelector('div#resultsTable');

    if (dealerVehicles.length < 1) {
        dealerVehicles = await fetchVehicles();
    }

    let vehicles = stockResults.querySelectorAll('div.vehicle-card');
    [...vehicles].forEach((vehicle) => {
        const vehicleHref = vehicle.querySelector("div.card-links a.details-link").href;
        const vehicleName = vehicle.querySelector("div.card-body .vehicle-full-title").innerHTML;
        const vehicleQuery = vehicleHref.split("vehicles/")[1];
        const dealerVehicle = dealerVehicles.filter((v) => {
            const vQuery = v.vehicle_url.replace("?svm=/stock/", "");
            return v.vehicle_name == vehicleName && vQuery == "vehicles/" + vehicleQuery
        });
        setVehicleDealerPrice(vehicle, dealerVehicle)
    })
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

const setVehicleDealerPrice = (vehicle, dealerVehicle) => {
    let vehiclePrice = vehicle.querySelector("div.vehicle-price-wrapper span.vehicle-price");

    if (dealerVehicle.length > 0) {
        vehiclePrice.innerHTML = new Intl.NumberFormat('nl-NL', {
            style: 'currency',
            currency: 'EUR',
        }).format(dealerVehicle[0].dealer_price);
    }
}

const _handleCanvasListener = (targetNode) => {
    const config = { childList: true, subtree: true };
    const callback = (mutationsList, observer) => {
        for (let mutation of mutationsList) {
            if (mutation.type === 'childList') {
                if (!initted) {
                    getVehicleElements();
                    _handleFiltersListener();
                    _handlePagerListener();
                    _handleSortFiltersListener();
                    _handleRemoveAllFiltersButtonListener();
                    _handlePriceFilterListener();
                    initted = true;
                }
            }
        }
    };

    const observer = new MutationObserver(callback);
    observer.observe(targetNode, config);
}

if (canvas && document.body.classList.contains("page-dealer-voorraad")) {
    _handleCanvasListener(canvas);
}