import _ from "lodash";

const canvas = document.querySelector("#svm-canvas");
var initted = false;

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
    const vehiclesWrapper = canvas.querySelector("form#whf_form #pageContainer #pageContent #stockContainer #stock #resultsTable")
    const vehicles = vehiclesWrapper.querySelectorAll(".vehicleTile")

    const filteredVehicles = _.sortBy([...vehicles], (vehicle) => {
        return vehicle.id
    })
    console.log(filteredVehicles);
    console.log(filteredVehicles[33]);
    console.log(filteredVehicles[1]);
}
if (canvas && document.body.classList.contains("page-home")) {
    console.log("canvas");
    _handleCanvasListener(canvas);
}