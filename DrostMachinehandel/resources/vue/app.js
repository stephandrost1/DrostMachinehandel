//Modules
import _ from "lodash";
import axios from "axios";
import { createApp } from 'vue'

import Toaster from '../../node_modules/@meforma/vue-toaster';

//Base page
import PageVehuur from './pages/verhuur.vue';
import PageDealerDetail from "./pages/dealer/detail.vue";

//External components
import verhuurStore from "./store/verhuur/home/store.js"

window._ = _;
window.axios = axios;

const verhuurApp = createApp(PageVehuur);
const DealerDetailApp = createApp(PageDealerDetail);

verhuurApp.use(verhuurStore);

if (document.querySelector("#page-verhuur-app")) {
    verhuurApp.mount("#page-verhuur-app");
}

function mountDealerDetailApp() {
    if (document.querySelector("#page-voorraad-detail-reservation-wrapper")) {
        DealerDetailApp.mount("#page-voorraad-detail-reservation-wrapper");

        return;
    }

    // Try again in 1 second, but stop after 30 tries
    if (count < 30) {
        setTimeout(mountDealerDetailApp, 1000);
        count++;
    }
}

var count = 0;
mountDealerDetailApp();

