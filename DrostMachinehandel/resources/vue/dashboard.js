//Modules
import _, { create } from "lodash";
import axios from "axios";
import { createApp } from 'vue'

//Base page
import PageVehuur from './pages/verhuur.vue';
import dealerRequests from './pages/dealerRequests.vue';

//External components
import verhuurStore from "./store/verhuur/store.js"
import dealersStore from "./store/dealers/store.js"
import Toaster from '../../node_modules/@meforma/vue-toaster';

window._ = _;
window.axios = axios;

const verhuurApp = createApp(PageVehuur);
const dealerNofiticationsApp = createApp(dealerRequests);

verhuurApp.use(verhuurStore);
verhuurApp.use(Toaster);

dealerNofiticationsApp.use(dealersStore);
dealerNofiticationsApp.use(Toaster);

if (document.querySelector("#page-dashboard-verhuur")) {
    verhuurApp.mount("#page-dashboard-verhuur");
}

if (document.querySelector("#page-dashboard-dealer-requests")) {
    dealerNofiticationsApp.mount("#page-dashboard-dealer-requests");
}