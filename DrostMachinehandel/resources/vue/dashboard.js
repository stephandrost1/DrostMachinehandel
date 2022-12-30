//Modules
import _, { create } from "lodash";
import axios from "axios";
import { createApp } from 'vue'

//Base page
import PageVehuur from './pages/verhuur.vue';
import PageDealerRequests from './pages/dealerRequests.vue';
import PageReservations from './pages/reservations.vue'
import PageDealerVehicles from './pages/dealerVehicles.vue'
import PageAccount from './pages/account.vue'

//External components
import verhuurStore from "./store/verhuur/store.js"
import dealersStore from "./store/dealers/store.js"
import dealerVehicleStore from "./store/dealers/vehicles/store.js"
import accountStore from "./store/account/store.js"

import Toaster from '../../node_modules/@meforma/vue-toaster';

window._ = _;
window.axios = axios;

const verhuurApp = createApp(PageVehuur);
const dealerNofiticationsApp = createApp(PageDealerRequests);
const reservationsApp = createApp(PageReservations);
const dealerVehiclesApp = createApp(PageDealerVehicles);
const accountApp = createApp(PageAccount);

verhuurApp.use(verhuurStore);
verhuurApp.use(Toaster);

dealerNofiticationsApp.use(dealersStore);
dealerVehiclesApp.use(dealerVehicleStore);

dealerNofiticationsApp.use(Toaster);
dealerVehiclesApp.use(Toaster);

accountApp.use(accountStore);
accountApp.use(Toaster);

if (document.querySelector("#page-dashboard-verhuur")) {
    verhuurApp.mount("#page-dashboard-verhuur");
}

if (document.querySelector("#page-dashboard-dealer-requests")) {
    dealerNofiticationsApp.mount("#page-dashboard-dealer-requests");
}

if (document.querySelector("#page-dashboard-reservations")) {
    reservationsApp.mount("#page-dashboard-reservations");
}

if (document.querySelector("#page-dashboard-dealer-vehicles")) {
    dealerVehiclesApp.mount("#page-dashboard-dealer-vehicles");
}

if (document.querySelector("#page-dashboard-account")) {
    accountApp.mount("#page-dashboard-account");
}