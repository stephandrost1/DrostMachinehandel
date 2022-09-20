import _ from 'lodash';

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

        return { images: vehicleImages, title: vehicleTitle.innerHTML, urlToVehicle: vehicleTitle.href, price: vehiclePrice }
    })
}

const generateVehicleCard = (vehicle) => {
    const card = document.createElement("div")
    card.classList = "vehicleCard bg-white text-black rounded-xl";

    const thumbnailWrapper = document.createElement("div");
    thumbnailWrapper.classList = "thumbnailWrapper"

    const thumbnail = document.createElement("img");
    thumbnail.src = vehicle.images[0].src;
    thumbnailWrapper.appendChild(thumbnail)

    const cardBody = document.createElement('div');
    cardBody.classList = "py-3";

    const cardTitle = document.createElement("h1");
    cardTitle.classList = "font-bold text-lg mb-2";
    cardTitle.innerHTML = vehicle.title
    cardBody.appendChild(cardTitle)

    const cardPrice = document.createElement("p");
    cardPrice.innerHTML = vehicle.price
    cardBody.appendChild(cardPrice)

    const detailsButton = document.createElement("button");
    detailsButton.classList = "mt-4 border-[3px] border-primary bg-primary text-white font-bold px-5 py-1 rounded-lg flex gap-5 items-center justify-center"

    const detailsButtonIcon = document.createElement("i");
    detailsButtonIcon.classList = "fas fa-chevron-right";
    detailsButton.appendChild(detailsButtonIcon)
    cardBody.appendChild(detailsButton)

    card.append(thumbnailWrapper);
    card.appendChild(cardBody);

    return card;
}

const _handleCanvasListener = (targetNode) => {
    const config = { childList: true, subtree: true };
    const callback = (mutationsList, observer) => {
        for (let mutation of mutationsList) {
            if (mutation.type === 'childList') {
                if (!initted) {
                    initNewContent(targetNode);
                    initted = true;
                }
            }
        }
    };

    const observer = new MutationObserver(callback);
    observer.observe(targetNode, config);
}

const initNewContent = (canvas) => {
    const form = canvas.querySelector('form.whsearch-form');
    const stockResults = form.querySelector('div#resultsTable');
    const vehicles = fetchVehicles();

    stockResults.replaceChildren([]);

    _.forEach(vehicles, (vehicle) => {
        stockResults.appendChild(generateVehicleCard(vehicle));
    });
}

_handleCanvasListener(canvas);