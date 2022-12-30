import axios from 'axios';
import _ from 'lodash';

const canvas = document.querySelector('#svm-canvas');
var initted = false;

const _formatMachineTitle = () => {
    const titleWrapper = document.querySelector("div.mainSpecsBlock");
    const title = titleWrapper.querySelectorAll("div:not(.svm-label)");
    const description = titleWrapper.querySelector("ul");
    description.classList = "vehicle-description-list"

    const newTitle = document.createElement("h1");
    newTitle.innerHTML = title[1].innerHTML ? title[0].innerHTML + ' ' + title[1].innerHTML : title[0].innerHTML;
    newTitle.classList = "vehicleTitle"

    titleWrapper.removeChild(title[0]);
    titleWrapper.removeChild(title[1]);

    titleWrapper.replaceChildren([]);
    titleWrapper.appendChild(newTitle);
    titleWrapper.appendChild(description);
}

const _reformatSpecs = () => {
    const specsList = document.querySelector(".specsList");
    const specItems = specsList.querySelectorAll("li");
    const newSpecList = document.querySelector(".vehicle-description-list");

    _.forEach([...specItems], (item) => {
        newSpecList.append(item);
    })
}

const _addContactButtons = () => {
    const wrapper = document.querySelector("#hcontact-block");

    if (!wrapper) {
        return;
    }

    const buttonsText = {
        "buy": {
            "en": "Contact",
            "fr": "Contacter",
            "de": "Kontakt",
            "nl": "Contact",
        },
        "rent": {
            "en": "Reserve",
            "fr": "Réserver",
            "de": "Reservieren",
            "nl": "Reserveren",
        }
    }

    const buttonsWrapper = document.createElement("div");
    buttonsWrapper.classList = "contact-buttons-wrapper flex justify-between";
    const buyButton = document.createElement("a");
    const rentButton = document.createElement("a");
    const language = document.querySelector('meta[name="current-lang"]').content

    const vehicleUrl = window.location.search.split("/");
    const vehicleId = vehicleUrl[vehicleUrl.indexOf("details") + 1]

    buyButton.classList = "buy-button";
    buyButton.innerHTML = buttonsText["buy"][language] ?? "Kopen";
    buyButton.href = `javascript:showContactMePopin(${vehicleId})`;
    rentButton.classList = "rent-button"
    rentButton.innerHTML = buttonsText["rent"][language] ?? "Huren";
    rentButton.href = `javascript:showContactMePopin(${vehicleId})`;

    buttonsWrapper.appendChild(buyButton);
    buttonsWrapper.appendChild(rentButton);
    wrapper.appendChild(buttonsWrapper);
}

const _addShareButtons = () => {
    const wrapper = document.querySelector("#hcontact-block");

    if (!wrapper) {
        return;
    }

    const shareTranslations = {
        "en": "Share this page:",
        "fr": "Partager cette page:",
        "de": "Teile diese Seite:",
        "nl": "Deel deze pagina:",
    }

    const language = document.querySelector('meta[name="current-lang"]').content;

    const shareButtonsWrapper = document.createElement("div");
    shareButtonsWrapper.classList = "share-buttons-wrapper";

    const header = document.createElement("div");
    header.innerHTML = shareTranslations[language] ?? "Share this page:";
    header.classList = "share-header";

    shareButtonsWrapper.append(header);

    const body = document.createElement("div");
    body.classList = "share-body";

    const whatsappLinkWrapper = document.createElement("div");
    whatsappLinkWrapper.classList = "whatsapp-link-wrapper"
    const whatsappLink = document.createElement("a");
    whatsappLink.classList = "whatsapp-link"
    whatsappLink.href = "whatsapp://send?text=Bekijk deze machine van Drostmachinehandel: " + window.location.href
    const whatsappLinkIcon = document.createElement("i");
    whatsappLinkIcon.classList = "fab fa-whatsapp"

    whatsappLink.append(whatsappLinkIcon)
    whatsappLink.append("Whatsapp");
    whatsappLinkWrapper.append(whatsappLink);
    body.append(whatsappLinkWrapper);

    const mailLinkWrapper = document.createElement("div");
    mailLinkWrapper.classList = "mail-link-wrapper"
    const mailLink = document.createElement("a");
    mailLink.classList = "mail-link"
    mailLink.href = "mailto:?subject=Bekijk deze machine op DrostMachinehandel.nl&body=Bekijk deze machine van Drostmachinehandel: " + window.location.href
    const mailLinkIcon = document.createElement("i");
    mailLinkIcon.classList = "far fa-envelope-open"

    mailLink.append(mailLinkIcon)
    mailLink.append("E-Mail");
    mailLinkWrapper.append(mailLink);
    body.append(mailLinkWrapper);

    shareButtonsWrapper.append(body);
    wrapper.append(shareButtonsWrapper);
}

const _handleDetailPageFormatter = () => {
    _formatMachineTitle();
    _reformatSpecs();
    _addContactButtons();
    _addShareButtons();
    _handlePriceOverwritter();
}

const fetchDealerPrice = async () => {
    const vehicleUrl = window.location.search;

    return await axios.get("/api/v1/dealer/vehicle/" + vehicleUrl)
        .then((response) => {
            return response.data.vehicle;
        })
}

const _handlePriceOverwritter = async () => {
    let price = canvas.querySelector("#hcontact-block #hprice .price .price_with_currency");
    const dealerVehicle = await fetchDealerPrice();

    price.innerHTML = new Intl.NumberFormat('nl-NL', {
        style: 'currency',
        currency: 'EUR',
    }).format(dealerVehicle.dealer_price);
}

const _handleCanvasListener = (targetNode) => {
    const config = { childList: true, subtree: true };
    const callback = (mutationsList, observer) => {
        for (let mutation of mutationsList) {
            if (mutation.type === 'childList') {
                if (!initted) {
                    _handleDetailPageFormatter();
                    initted = true;
                }
            }
        }
    };

    const observer = new MutationObserver(callback);
    observer.observe(targetNode, config);
}

if (canvas && document.body.classList.contains("page-dealer-voorraad-detail")) {
    _handleCanvasListener(canvas);
}