import "./bootstrap";
import App from "./App.vue";
import { createApp } from "vue";
import { createPinia } from "pinia";

import axios from "axios";
window.axios = axios;

import router from "../../resources/js/router/index.js";

import "bootstrap/dist/css/bootstrap-grid.min.css";
import "bootstrap/dist/css/bootstrap-utilities.min.css";

// Import Vuetify
import vuetify from "./plugins/vuetify.js";

const app = createApp(App);
app.use(createPinia());
app.use(vuetify);
app.use(router);
// app.use(antdv);
app.mount("#app");
