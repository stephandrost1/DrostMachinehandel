import _ from "lodash";
import { createApp } from 'vue'

import PageVehuur from './pages/verhuur.vue';

import VShowSlide from 'v-show-slide'

createApp(PageVehuur).use(VShowSlide).mount("#page-dashboard-verhuur");