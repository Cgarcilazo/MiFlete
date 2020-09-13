'use strict';
import axios from 'axios';
import store from 'Base/store';

export const requestInterceptor = axios.interceptors.request.use((config) => {
  if (store.getters['users/isAuthenticated']) {
    config.headers['Authorization'] = `Bearer ${store.state.users.token}`;
  }

  return config;
});

let isRefreshing = false;
let requestsQueue = [];

function proccessQueued (token) {
  requestsQueue.map(cb => cb(token));
}

function queueRequests (cb) {
  requestsQueue.push(cb);
}

export const responseInterceptor = axios.interceptors.response.use(null, error => {
  const { config, response } = error;

  //Logout user if it wasn't possible to refresh the token
  if (config.url.includes('/users/refresh')) {
    store.commit('users/logout');
    return Promise.reject(error);
  }

  //Return the error if it's not related to authentication
  if (!response || response.status !== 401) {
    return Promise.reject(error);
  }

  //Start token refreshing process if it's not in progress
  if (!isRefreshing) {
    isRefreshing = true
    store.dispatch('users/refresh').then(token => {
      isRefreshing = false;
      proccessQueued(token);
      requestsQueue = [];
    })
  }

  //Add a callback for every request that needs a new token
  return new Promise(resolve => {
    queueRequests(token => {
      config.headers['Authorization'] = `Bearer ${token}`
      resolve(axios.request(config))
    })
  })
})

export default {
  requestInterceptor,
  responseInterceptor,
}