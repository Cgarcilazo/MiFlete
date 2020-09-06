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

};

export const actions = {
  register ({ commit }, payload) {
    return new Promise((resolve, reject) => {
      axios.post('/api/v1/register', payload)
        .then(response => {
          resolve(response);
        })
        .catch(error => {
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