'use strict';

export const isPublicRoute = (to, from, next) => {
  console.log('here', to);
  return next();
}

export default {
  isPublicRoute,
}