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

const _handleDetailPageFormatter = () => {
    _formatMachineTitle();
    _reformatSpecs();
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



if (canvas && document.body.classList.contains("page-machineDetail")) {
    _handleCanvasListener(canvas);
}