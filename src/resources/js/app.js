import 'bootstrap';
import Vue from 'vue';
import App from 'Components/Main';
import { router } from './vue/router'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faBoxOpen, faKey, faTruckMoving } from '@fortawesome/free-solid-svg-icons'
import { faEnvelope, faUser } from '@fortawesome/free-regular-svg-icons'
import { ValidationProvider, ValidationObserver } from 'vee-validate';
import validationRules from 'Base/validator';

library.add(faBoxOpen, faEnvelope, faUser, faKey, faTruckMoving);

Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);

const vm = new Vue({
  router,
  validationRules,
  render: h => h(App)
}).$mount('#app');
