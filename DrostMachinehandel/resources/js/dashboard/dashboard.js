import _ from "lodash";

import "./global";

import "./analytics";

import "./verhuur/edit";
import "./verhuur/create";
import "./verhuur/sidebar";

import { createApp } from 'vue'
import dmTest from '../components/dm-test.vue';

createApp(dmTest).mount("#app");

// app.component("dm-test", dmTest);