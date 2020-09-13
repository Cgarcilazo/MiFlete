'use strict';

//Route names
import { CARRIER_HOME_ROUTE } from 'Constants/carriers/routes';

//Components
import Home from 'Components/views/carriers/Home';

const routes = [
  {
    path: '/',
    redirect: { name: CARRIER_HOME_ROUTE },
    meta: {
      public: false,
    },
  },
  {
    name: CARRIER_HOME_ROUTE,
    path: 'home',
    component: Home,
    meta: {
      public: false,
    },
  },
];

export default routes;