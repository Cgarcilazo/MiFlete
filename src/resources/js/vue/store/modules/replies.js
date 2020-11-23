'use strict';
import axios from 'axios';

const getDefaultState = () => {
  return {
    replies: [],
  }
};

export const state = getDefaultState();

export const getters = {

};

export const mutations = {

};

export const actions = {
  create ({rootGetters}, payload) {
    return new Promise((resolve, reject) => {
      const userId = rootGetters['users/getUser'].id || null;
      axios.post(`/api/v1/users/${userId}/app-requests/${payload.requestId}/replies`, payload)
        .then(() => {
          resolve();
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