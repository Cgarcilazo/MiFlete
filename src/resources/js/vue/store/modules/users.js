'use strict';
import axios from 'axios';
import router from 'Base/router';
import { LANDING_ROUTE } from 'Constants/general/routes';

const getDefaultState = () => {
  return {
    token: localStorage.getItem('token'),
    user: null,
  }
};

export const state = getDefaultState();

export const getters = {
  isClient (state) {
    return (state.user != null && state.user['is_client'] != null && state.user['is_client']);
  },

  isCarrier (state) {
    return (state.user != null && state.user['is_carrier'] != null && state.user['is_carrier']);
  },

  isAuthenticated (state) {
   return state.token != null;
  },

  getUser (state) {
    return state.user || getDefaultState().user
  }
};

export const mutations = {
  setUser (state, user) {
    state.user = user;
  },

  setToken (state, token) {
    state.token = token;

    localStorage.setItem('token', token);
  },

  logout(state) {
    state.token = null;
    state.user = null;
    localStorage.removeItem('token');
    router.push({ name: LANDING_ROUTE});
  },
};

export const actions = {
  register ({ commit }, payload) {
    return new Promise((resolve, reject) => {
      axios.post('/api/v1/register', payload)
        .then(response => {
          const user = response.data.data.user;
          const token = response.data.data.token;
          commit('setUser', user);
          commit('setToken', token);
          resolve(response);
        })
        .catch(error => {
          reject(error);
        })
    });
  },

  login ({ commit }, payload) {
    return new Promise((resolve, reject) => {
      axios.post('/api/v1/login', payload)
        .then(response => {
          const user = response.data.data.user;
          const token = response.data.data.token;
          commit('setUser', user);
          commit('setToken', token);
          resolve(response);
        })
        .catch(error => {
          reject(error);
        })
    });
  },

  refresh ({ commit }) {
    return new Promise((resolve, reject) => {
      axios.post('/api/v1/users/refresh')
        .then((response) => {
          const token = response.data.data.token;
          commit('setToken', token);
          resolve(response);
        })
        .catch((error) => {
          reject(error);
        })
    })
  },

  fetchUser ({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get('/api/v1/getUser')
        .then((response) => {
          const user = response.data.data.user;
          commit('setUser', user);
          resolve(response);
        })
        .catch((error) => {
          reject(error);
        })
    });
  },
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
}