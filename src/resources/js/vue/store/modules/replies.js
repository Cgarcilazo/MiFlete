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
  setReplies (state, replies) {
    state.replies = replies;
  },
};

export const actions = {
  fetchAllByCarrier ({ commit, rootGetters }) {
    return new Promise((resolve, reject) => {
      const userId = rootGetters['users/getUser'].id || null;
      axios.get(`/api/v1/users/${userId}/replies`)
        .then((response) => {
          const replies = response.data.data.replies || [];
          commit('setReplies', replies);
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
      axios.post(`/api/v1/users/${userId}/app-requests/${payload.requestId}/replies`, payload)
        .then(() => {
          resolve();
        })
        .catch((error) => {
          reject(error);
        })
    });
  },

  cancel ({ rootGetters }, payload) {
    const userId = rootGetters['users/getUser'].id || null;
    return new Promise((resolve, reject) => {
      axios.put(`/api/v1/users/${userId}/replies/${payload.id}/cancel`)
        .then(() => {
          resolve();
        })
        .catch((error) => {
          reject(error);
        })
    })
  },
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
}