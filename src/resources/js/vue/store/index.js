'use strict';

import Vue from 'vue';
import Vuex from 'vuex';

import users from 'Base/store/modules/users';
import requests from 'Base/store/modules/requests';

Vue.use(Vuex);

const store = new Vuex.Store({
  modules: {
    users,
    requests,
  }
});

export default store;