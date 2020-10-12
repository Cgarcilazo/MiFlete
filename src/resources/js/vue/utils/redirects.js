'use strict';

import store from 'Base/store';

//Home routes
import { CLIENT_HOME_ROUTE, EDIT_USER_CLIENT } from 'Constants/clients/routes';
import { CARRIER_HOME_ROUTE, EDIT_USER_CARRIER } from 'Constants/carriers/routes';

export const getHomePage = () => {
  const isClient = store.getters['users/isClient'];

  return isClient
    ? { name: CLIENT_HOME_ROUTE }
    : { name: CARRIER_HOME_ROUTE };
}

export const getEditPage = () => {
  const isClient = store.getters['users/isClient'];

  return isClient
    ? { name: EDIT_USER_CLIENT }
    : { name: EDIT_USER_CARRIER };
}

export default {
  getHomePage,
  getEditPage,
}