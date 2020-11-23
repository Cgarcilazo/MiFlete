'use strict';
import axios from 'axios';

const getDefaultState = () => {
  return {
    requests: [],
    pendingRequests: [],
    replies: [],
  }
};

export const state = getDefaultState();

export const getters = {

};

export const mutations = {
  setRequests (state, requests) {
    state.requests = requests;
  },

  setPendingRequests (state, requests) {
    state.pendingRequests = requests;
  },

  setReplies (state, replies) {
    state.replies = replies;
  },
};

export const actions = {
  fetchAllByClient ({ commit, rootGetters }) {
    return new Promise((resolve, reject) => {
      const userId = rootGetters['users/getUser'].id || null;
      axios.get(`/api/v1/users/${userId}/app-requests`)
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

  fetchAllPending ({ commit, rootGetters }) {
    return new Promise((resolve, reject) => {
      const userId = rootGetters['users/getUser'].id || null;
      axios.get(`/api/v1/users/${userId}/app-requests/all-pending`)
        .then((response) => {
          const requests = response.data.data.requests || [];
          commit('setPendingRequests', requests);
          resolve(response);
        })
        .catch((error) => {
          reject(error);
        })
    });
  },

  fetchDetail ({ commit, rootGetters }, payload) {
    return new Promise((resolve, reject) => {
      const userId = rootGetters['users/getUser'].id || null;
      axios.get(`/api/v1/users/${userId}/app-requests/${payload.id}`)
        .then((response) => {
          const request = response.data.data.request || [];
          commit('setRequest', request);
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
      axios.post(`/api/v1/users/${userId}/app-requests`, payload)
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
      axios.put(`/api/v1/users/${userId}/app-requests/${payload.id}/cancel`)
        .then(() => {
          resolve();
        })
        .catch((error) => {
          reject(error);
        })
    })
  },

  acceptReply ({ rootGetters }, payload) {
    const userId = rootGetters['users/getUser'].id || null;
    return new Promise((resolve, reject) => {
      axios.put(`/api/v1/users/${userId}/app-requests/${payload.requestId}/replies/${payload.replyId}/accept`)
        .then(() => {
          resolve();
        })
        .catch((error) => {
          reject(error);
        })
    })
  },

  fetchReplies ({ rootGetters, commit }, requestId) {
    const userId = rootGetters['users/getUser'].id || null;
    return new Promise((resolve, reject) => {
      axios.get(`/api/v1/users/${userId}/app-requests/${requestId}/replies`)
        .then((response) => {
          const replies = response.data.data.replies;
          commit('setReplies', replies);
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