import _, { filter } from 'lodash';
import { generateVehicleCard } from '../helpers/vehicleCard';

const canvas = document.querySelector('#svm-canvas');
var initted = false;

const generateImagesArray = (sources) => {
    return _.map(sources, (source) => {
        return { maxWidth: source.media.replace(/\D/g, ''), src: 'https:' + source.srcset }
    });
}

const fetchVehicles = () => {
    const canvas = document.getElementById('svm-canvas');
    const form = canvas.querySelector('form.whsearch-form');
    const stockResults = form.querySelector('div#resultsTable');

    let vehicles = stockResults.querySelectorAll('div.vehicleTile');

    return _.map(vehicles, (vehicle) => {
        const vehicleImages = generateImagesArray(vehicle.querySelector('a.vehicleImage').querySelectorAll('source'));
        const vehicleTitle = vehicle.querySelector('div.mmt').querySelector('a.toTop')
        const vehiclePrice = vehicle.querySelector('span.price_with_currency').innerHTML;
        const vehiclePriceSubText = vehicle.querySelector('span.price_btw').innerHTML;
        const vehicleActions = vehicle.querySelectorAll('.detailsButton');
        const vehicleDescription = vehicle.querySelector('div.specs').innerHTML;

        return {
            images: vehicleImages,
            title: vehicleTitle.innerHTML,
            urlToVehicle: vehicleTitle.href,
            price: vehiclePrice,
            priceSubText: vehiclePriceSubText,
            description: vehicleDescription,
            actions: {
                contact: {
                    text: vehicleActions[1].innerHTML,
                    action: vehicleActions[1].href
                },
                details: {
                    text: vehicleActions[0].innerHTML,
                    action: vehicleActions[0].search
                }
            },
        }
    })
}

const _handleCanvasListener = (targetNode) => {
    const config = { childList: true, subtree: true };
    const callback = (mutationsList, observer) => {
        for (let mutation of mutationsList) {
            if (mutation.type === 'childList' && (mutation.target.id === "svm-canvas" || mutation.target.id === "resultsTable") && !initted) {
                initNewContent(targetNode);
                _handleFiltersListener();
                _handlePagerListener();
                initted = true;
            }
        }
    };

    const observer = new MutationObserver(callback);
    observer.observe(targetNode, config);
}

const initNewContent = (canvas) => {
    const form = canvas.querySelector('form.whsearch-form');

    if (!form) {
        return;
    }

    const stockResults = form.querySelector('div#resultsTable');

    if (!stockResults) {
        return;
    }

    const vehicles = fetchVehicles();

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

const _handlePagerListener = () => {
    const pagers = document.querySelectorAll("#svm-canvas #pageContent #stock .navigation .pager a.page");

    _.forEach([...pagers], (pager) => {
        pager.addEventListener("click", () => {
            initted = false;
        })
    });
}

if (canvas && document.body.classList.contains("page-voorraad")) {
    _handleCanvasListener(canvas);
}