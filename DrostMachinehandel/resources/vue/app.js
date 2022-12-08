//Modules
import _ from "lodash";
import axios from "axios";
import { createApp } from "vue";

//Base page
import dealerCreate from "./pages/dealerCreate.vue";

//Goobal window funcitons
window._ = _;
window.axios = axios;

const dealerCreateApp = createApp(dealerCreate);

// dealerCreateApp.mount("#page-dealer-create");