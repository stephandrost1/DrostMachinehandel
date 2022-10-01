import _ from "lodash";
import { fetchVehicles, generateVehicleCard } from "../helpers/vehicleCard";

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

const initNewContent = () => {
    const vehicles = fetchVehicles().splice(0, 5);
    const recentlyAddedWrapper = document.querySelector("#recently-added-items");

    if (!recentlyAddedWrapper) {
        return;
    }

    recentlyAddedWrapper.replaceChildren([]);

    _.forEach(vehicles, (vehicle) => {
        recentlyAddedWrapper.append(generateVehicleCard(vehicle));
    });
}

if (canvas && document.body.classList.contains("page-home")) {
    _handleCanvasListener(canvas);
}