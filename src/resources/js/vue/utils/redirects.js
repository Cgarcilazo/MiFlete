'use strict';

import store from 'Base/store';

//Home routes
import { CLIENT_HOME_ROUTE } from 'Constants/clients/routes';
import { CARRIER_HOME_ROUTE } from 'Constants/carriers/routes';

export const getHomePage = () => {
  const isClient = store.getters['users/isClient'];

  return isClient
    ? { name: CLIENT_HOME_ROUTE }
    : { name: CARRIER_HOME_ROUTE };
}

export default {
  getHomePage,
}