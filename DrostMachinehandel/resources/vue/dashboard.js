//Modules
import _ from "lodash";
import axios from "axios";
import { createApp } from 'vue'

//Base page
import PageVehuur from './pages/dashboard/verhuur.vue';
import PageDealerRequests from './pages/dashboard/dealerRequests.vue';
import PageReservations from './pages/dashboard/reservations.vue'
import PageDealerVehicles from './pages/dashboard/dealerVehicles.vue'
import PageDealerAccount from './pages/dashboard/account/dealer.vue'
import PageAdminAccount from './pages/dashboard/account/admin.vue'

//External components
import verhuurStore from "./store/verhuur/store.js"
import dealersStore from "./store/dealers/store.js"
import dealerVehicleStore from "./store/dealers/vehicles/store.js"
import dealerAccountStore from "./store/account/dealer/store.js"
import adminAccountStore from "./store/account/admin/store.js"

import Toaster from '../../node_modules/@meforma/vue-toaster';

window._ = _;
window.axios = axios;

const verhuurApp = createApp(PageVehuur);
const dealerNofiticationsApp = createApp(PageDealerRequests);
const reservationsApp = createApp(PageReservations);
const dealerVehiclesApp = createApp(PageDealerVehicles);
const dealerAccountApp = createApp(PageDealerAccount);
const adminAccountApp = createApp(PageAdminAccount);

verhuurApp.use(verhuurStore);
verhuurApp.use(Toaster);

dealerNofiticationsApp.use(dealersStore);
dealerVehiclesApp.use(dealerVehicleStore);
adminAccountApp.use(adminAccountStore);
dealerAccountApp.use(dealerAccountStore);

dealerNofiticationsApp.use(Toaster);
dealerVehiclesApp.use(Toaster);
dealerAccountApp.use(Toaster);
dealerAccountApp.use(Toaster);
adminAccountApp.use(Toaster);

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

if (document.querySelector("#page-dashboard-dealer-account")) {
    dealerAccountApp.mount("#page-dashboard-dealer-account");
}

if (document.querySelector("#page-dashboard-admin-account")) {
    adminAccountApp.mount("#page-dashboard-admin-account");
}