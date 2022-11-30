//Modules
import _ from "lodash";
import axios from "axios";
import { createApp } from 'vue'

//Base page
import PageVehuur from './pages/verhuur.vue';

//External components
import store from "./store/store.js"
import Toaster from '../../node_modules/@meforma/vue-toaster';

window._ = _;
window.axios = axios;

const app = createApp(PageVehuur)

app.use(store);
app.use(Toaster);

app.mount("#page-dashboard-verhuur");