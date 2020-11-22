import 'bootstrap';
import Vue from 'vue';
import App from 'Components/Main';
import router from './vue/router'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faBoxOpen, faKey, faTruck, faUserPlus, faSignInAlt, faSignOutAlt, faCheck, faClipboardList,
  faEdit, faAngleRight, faSearchDollar, faUsers, faHome, faPlus, faExternalLinkAlt } from '@fortawesome/free-solid-svg-icons'
import { faEnvelope, faUser, faTrashAlt } from '@fortawesome/free-regular-svg-icons'
import { ValidationProvider, ValidationObserver } from 'vee-validate';
import validationRules from 'Base/validator';
import store from 'Base/store';
import Toast from "vue-toastification";
import 'vue-toastification/dist/index.css';
import { requestInterceptor, responseInterceptor } from 'Base/services/interceptors';

library.add(faBoxOpen, faEnvelope, faUser, faKey, faTruck, faUserPlus, faSignInAlt, faCheck,
  faClipboardList, faEdit, faAngleRight, faSearchDollar, faUsers, faSignOutAlt, faHome, faPlus,
  faTrashAlt, faExternalLinkAlt);

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
  requestInterceptor,
  responseInterceptor,
  render: h => h(App)
}).$mount('#app');
