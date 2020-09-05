import 'bootstrap';
import Vue from 'vue';
import App from 'Components/Main';
import { router } from './vue/router'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faBoxOpen, faKey } from '@fortawesome/free-solid-svg-icons'
import { faEnvelope } from '@fortawesome/free-regular-svg-icons'

library.add(faBoxOpen, faEnvelope, faKey)

Vue.component('font-awesome-icon', FontAwesomeIcon)

const vm = new Vue({
  router,
  render: h => h(App)
}).$mount('#app');
