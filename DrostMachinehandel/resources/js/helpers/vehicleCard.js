const detail_page = "/voorraad/machine";

const getVehicleTitle = (title) => {
    return title.length > 50 ? title.slice(0, 47) + '...' : title;
}

const getVehicleImage = (images) => {
    return _.filter(images, (image, key) => {
        if ((parseInt(window.innerWidth) < parseInt(image.maxWidth) && (parseInt(key) + 1) !== images.length) || (parseInt(window.innerWidth) > parseInt(image.maxWidth) && (parseInt(key) + 1) === images.length)) {
            return image;
        }
    })[0];
}

const generateVehicleCard = (vehicle) => {
    const card = document.createElement("div");
    card.classList = "vehicle-card swiper-slide";
    const thumbnailWrapper = document.createElement("div");
    thumbnailWrapper.classList = "thumbnail-wrapper"
    const thumbnail = document.createElement("img");
    thumbnail.src = getVehicleImage(vehicle.images).src;
    thumbnail.classList = "vehicle-thumbnail";
    thumbnailWrapper.appendChild(thumbnail);
    card.appendChild(thumbnailWrapper);

    const cardBody = document.createElement("div");
    const cardBodyCol1 = document.createElement("div");
    cardBodyCol1.classList = "vehicle-description-content"
    const cardBodyCol2 = document.createElement("div");
    cardBodyCol2.classList = "vehicle-price-content"
    cardBody.classList = "card-body"
    const vehicleTitle = document.createElement("a");
    vehicleTitle.classList = "vehicle-title";
    vehicleTitle.innerHTML = getVehicleTitle(vehicle.title);
    cardBodyCol1.appendChild(vehicleTitle);

    const cardLinks = document.createElement("div");
    cardLinks.classList = "card-links"

    const contactLink = document.createElement("a");
    contactLink.classList = "contact-link"
    contactLink.href = vehicle.actions.contact.action;
    contactLink.innerHTML = vehicle.actions.contact.text;

    const detailsLink = document.createElement("a");
    detailsLink.classList = "details-link"
    detailsLink.href = detail_page + vehicle.actions.details.action;
    detailsLink.innerHTML = vehicle.actions.details.text;
    cardLinks.appendChild(contactLink);
    cardLinks.appendChild(detailsLink);
    cardBodyCol1.appendChild(cardLinks);

    const description = document.createElement("div");
    description.classList = "vehicle-description"
    description.innerHTML = vehicle.description;
    cardBodyCol1.appendChild(description);

    const vehiclePriceWrapper = document.createElement("div");
    vehiclePriceWrapper.classList = "vehicle-price-wrapper";
    const vehiclePrice = document.createElement("span");
    vehiclePrice.classList = "vehicle-price";
    vehiclePrice.innerHTML = vehicle.price;

    const vehiclePriceText = document.createElement("span");
    vehiclePriceText.classList = "vehicle-price-sub-text"
    vehiclePriceText.innerHTML = vehicle.priceSubText;
    vehiclePriceWrapper.appendChild(vehiclePrice);
    vehiclePriceWrapper.appendChild(vehiclePriceText);
    cardBodyCol2.appendChild(vehiclePriceWrapper);

    cardBody.appendChild(cardBodyCol1)
    cardBody.appendChild(cardBodyCol2)
    card.appendChild(cardBody);

    return card;
}

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

export {
    generateVehicleCard,
    fetchVehicles
}

