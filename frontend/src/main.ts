import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import axios from "axios";
import store from "./store";
import 'bootstrap/dist/css/bootstrap.min.css';  // Importez les styles CSS de Bootstrap
import 'bootstrap';

axios.defaults.baseURL = "http://127.0.0.1:8000/api"; // Changez cette URL avec celle de votre backend

// Ajouter Axios à Vue prototype
Vue.prototype.$http = axios;

Vue.config.productionTip = false;


new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");

