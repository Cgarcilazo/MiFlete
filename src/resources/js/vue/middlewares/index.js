'use strict';

import store from 'Base/store';
import { getHomePage } from 'Base/utils/redirects';

export const isPublicRoute = (to, from, next) => {
  const isPublic = to.meta.public || false;
  const isAuthenticated = store.getters['users/isAuthenticated'];

  if (isPublic) {
    if (isAuthenticated) {
      next(getHomePage()); //Get home page according user type
    } else {
      next();
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
      next();
    } else {
      next({ name: 'landing' }); //Go to landing
    }
  } else {
    next();
  }
}

export default {
  isPublicRoute,
  isPrivateRoute,
}