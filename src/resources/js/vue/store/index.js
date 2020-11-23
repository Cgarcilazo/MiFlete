'use strict';

import Vue from 'vue';
import Vuex from 'vuex';

import users from 'Base/store/modules/users';
import requests from 'Base/store/modules/requests';
import replies from 'Base/store/modules/replies';

Vue.use(Vuex);

const store = new Vuex.Store({
  modules: {
    users,
    requests,
    replies,
  }
});

export default store;