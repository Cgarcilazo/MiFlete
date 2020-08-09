require('./bootstrap');
import Vue from 'vue';
import App from 'Components/Main';

const vm = new Vue({
    render: h => h(App)
  }).$mount('#app');
