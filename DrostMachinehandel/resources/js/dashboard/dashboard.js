import _ from "lodash";

import "./global";

import "./analytics";

import "./verhuur/edit";
import "./verhuur/create";
import "./verhuur/sidebar";

import { createApp } from 'vue'
import test from '../components/test.vue';


const app = createApp()

app.mount("#app");

app.component("test-test", test);