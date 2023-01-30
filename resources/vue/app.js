//Modules
import _, { create } from "lodash";
import axios from "axios";
import { createApp } from 'vue'

//Base page
import PageVehuur from './pages/verhuur/verhuur.vue';
import PageRentDetailReservationForm from "./pages/verhuur/detail/reservation-form.vue";
import ImageSlider from "./pages/verhuur/detail/images-slider.vue";
import PageLease from "./pages/lease/lease.vue";

//External components
import verhuurStore from "./store/verhuur/home/store.js"

window._ = _;
window.axios = axios;

const verhuurApp = createApp(PageVehuur);
const RentDetailReservationFormApp = createApp(PageRentDetailReservationForm);
const ImageSliderApp = createApp(ImageSlider);
const leaseApp = createApp(PageLease);

verhuurApp.use(verhuurStore);

if (document.querySelector("#page-verhuur-app")) {
    verhuurApp.mount("#page-verhuur-app");
}

if (document.querySelector("#dm-images-slider-app")) {
    ImageSliderApp.mount("#dm-images-slider-app");
}

if (document.querySelector("#lease-app")) {
    leaseApp.mount("#lease-app");
}

function mountRentDetailApp() {
    if (document.querySelector("#reservation-popup-rent-detail")) {
        RentDetailReservationFormApp.mount("#reservation-popup-rent-detail");
        return;
    }

    // Try again in 1 second, but stop after 30 tries
    if (count < 30) {
        setTimeout(mountRentDetailApp, 1000);
        count++;
    }
}

var count = 0;
mountRentDetailApp();

