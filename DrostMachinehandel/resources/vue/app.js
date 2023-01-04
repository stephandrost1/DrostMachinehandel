//Modules
import _ from "lodash";
import axios from "axios";
import { createApp } from 'vue'

import Toaster from '../../node_modules/@meforma/vue-toaster';

//Base page
import PageVehuur from './pages/verhuur/verhuur.vue';
import PageRentDetail from "./pages/verhuur/detail.vue";

//External components
import verhuurStore from "./store/verhuur/home/store.js"

window._ = _;
window.axios = axios;

const verhuurApp = createApp(PageVehuur);
const RentDetailApp = createApp(PageRentDetail);

verhuurApp.use(verhuurStore);

if (document.querySelector("#page-verhuur-app")) {
    verhuurApp.mount("#page-verhuur-app");
}

function mountRentDetailApp() {
    if (document.querySelector("#reservation-popup-rent-detail")) {
        RentDetailApp.mount("#reservation-popup-rent-detail");
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

