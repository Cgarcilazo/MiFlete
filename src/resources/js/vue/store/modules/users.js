'use strict';
import axios from 'axios';

const getDefaultState = () => {
  return {
    token: localStorage.getItem('token'),
    user: null,
  }
};

export const state = getDefaultState();

export const getters = {

};

export const mutations = {
  setUser (state, user) {
    state.user = user;
  },

  setToken (state, token) {
    state.token = token;

    localStorage.setItem('token', token);
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
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
}