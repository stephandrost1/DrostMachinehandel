//Modules
import _ from "lodash";
import axios from "axios";
import { createApp } from 'vue'

//Base page
import PageVehuur from './pages/verhuur.vue';

//External components
import verhuurStore from "./store/verhuur/home/store.js"

window._ = _;
window.axios = axios;

const verhuurApp = createApp(PageVehuur);

verhuurApp.use(verhuurStore);

if (document.querySelector("#page-verhuur-app")) {
    verhuurApp.mount("#page-verhuur-app");
}
