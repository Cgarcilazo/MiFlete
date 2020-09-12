import 'bootstrap';
import Vue from 'vue';
import App from 'Components/Main';
import router from './vue/router'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faBoxOpen, faKey, faTruckMoving } from '@fortawesome/free-solid-svg-icons'
import { faEnvelope, faUser } from '@fortawesome/free-regular-svg-icons'
import { ValidationProvider, ValidationObserver } from 'vee-validate';
import validationRules from 'Base/validator';
import store from 'Base/store';
import Toast from "vue-toastification";
import 'vue-toastification/dist/index.css'

library.add(faBoxOpen, faEnvelope, faUser, faKey, faTruckMoving);

Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);
Vue.use(Toast, {
  transition: 'Vue-Toastification__bounce',
  maxToasts: 3,
  newestOnTop: true,
  position: 'top-right',
  timeout: 4000,
  closeOnClick: true,
  pauseOnFocusLoss: true,
  pauseOnHover: true,
  draggable: false,
  showCloseButtonOnHover: false,
  hideProgressBar: false,
  closeButton: 'button',
  icon: true,
  rtl: false
})

const vm = new Vue({
  router,
  validationRules,
  store,
  render: h => h(App)
}).$mount('#app');
