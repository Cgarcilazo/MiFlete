'use strict';

import store from 'Base/store';
import { getHomePage } from 'Base/utils/redirects';
import { LANDING_ROUTE } from 'Constants/general/routes';

export const isPublicRoute = (to, from, next) => {
  const isPublic = to.meta.public || false;
  const isAuthenticated = store.getters['users/isAuthenticated'];

  if (isPublic) {
    if (isAuthenticated) {
      return next(getHomePage()); //Get home page according user type
    } else {
      return next();
    }
  } else {
    return next();
  }
}

export const isPrivateRoute = (to, from, next) => {
  const isPublic = to.meta.public || false;
  const isAuthenticated = store.getters['users/isAuthenticated'];

  if (!isPublic) {
    if (isAuthenticated) {
      return next();
    } else {
      return next({ name: LANDING_ROUTE }); //Go to landing
    }
  } else {
    return next();
  }
}

export const onlyForClients = (to, from, next) => {
  const isClient = store.getters['users/isClient'];
  console.log(isClient,'client');

  return isClient
    ? next()
    : next(getHomePage());
}

export const onlyForCarriers = (to, from, next) => {
  const isCarrier = store.getters['users/isCarrier'];

  return isCarrier
    ? next()
    : next(getHomePage());
}

export const fetchUser = (to, from, next) => {
  const user = store.state.users.user;

  if (user != null) {
    return next();
  } else {
    store.dispatch('users/fetchUser')
      .finally(() => {
        return next();
      })
  }
}

export default {
  isPublicRoute,
  isPrivateRoute,
  onlyForClients,
  onlyForCarriers,
}