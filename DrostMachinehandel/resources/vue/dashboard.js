//Modules
import _, { create } from "lodash";
import axios from "axios";
import { createApp } from 'vue'

//Base page
import PageVehuur from './pages/verhuur.vue';
import dealerRequests from './pages/dealerRequests.vue';
import dealerRequests from './pages/dealerRequests.vue';
import dealerCreate from "./pages/dealerCreate.vue";

//External components
import store from "./store/store.js"
import Toaster from '../../node_modules/@meforma/vue-toaster';

window._ = _;
window.axios = axios;

const verhuurApp = createApp(PageVehuur);
const dealerNofiticationsApp = createApp(dealerRequests);
const dealerCreateApp = createApp(dealerCreate);

verhuurApp.use(store);
verhuurApp.use(Toaster);

verhuurApp.mount("#page-dashboard-verhuur");
dealerNofiticationsApp.mount("#page-dashboard-dealer-requests");
dealerCreateApp.mount("#page-dealer-create");