import axios from "axios";

const canvas = document.querySelector('#svm-canvas');
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

    const dealerVehicles = await fetchVehicles();

    let vehicles = stockResults.querySelectorAll('div.vehicle-card');

    [...vehicles].forEach((vehicle) => {
        const vehicleHref = vehicle.querySelector("div.card-links a.details-link").href;
        const vehicleQuery = vehicleHref.replace(window.location.href + "/machine", "");

        const dealerVehicle = dealerVehicles.filter((v) => v.vehicle_url == vehicleQuery);

        setVehicleDealerPrice(vehicle, dealerVehicle)
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
                    fetchVehicles();
                    getVehicleElements();
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