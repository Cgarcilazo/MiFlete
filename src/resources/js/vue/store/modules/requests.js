'use strict';
import axios from 'axios';

const getDefaultState = () => {
  return {
    requests: [],
  }
};

export const state = getDefaultState();

export const getters = {

};

export const mutations = {
  setRequests (state, requests) {
    state.requests = requests;
  }
};

export const actions = {
  fetchAll ({ commit, rootGetters }) {
    return new Promise((resolve, reject) => {
      const userId = rootGetters['users/getUser'].id || null;
      axios.get(`/api/v1/users/${userId}/requests`)
        .then((response) => {
          const requests = response.data.data.requests || [];
          commit('setRequests', requests);
          resolve(response);
        })
        .catch((error) => {
          reject(error);
        })
    });
  },

  create ({rootGetters}, payload) {
    return new Promise((resolve, reject) => {
      const userId = rootGetters['users/getUser'].id || null;
      axios.post(`/api/v1/users/${userId}/requests`, payload)
        .then(() => {
          resolve();
        })
        .catch((error) => {
          reject(error);
        })
    });
  }
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
}