import _ from "lodash";
import { createApp } from 'vue'

import PageVehuur from './pages/verhuur.vue';
import store from "./store/store.js"

const app = createApp(PageVehuur)

app.use(store);

app.mount("#page-dashboard-verhuur");