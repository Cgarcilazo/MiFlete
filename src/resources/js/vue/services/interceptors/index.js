'use strict';
import axios from 'axios';
import store from 'Base/store';

export const requestInterceptor = axios.interceptors.request.use((config) => {
  if (store.getters['users/isAuthenticated']) {
    config.headers['Authorization'] = `Bearer ${store.state.users.token}`;
  }

  return config;
})

export default {
  requestInterceptor,
}