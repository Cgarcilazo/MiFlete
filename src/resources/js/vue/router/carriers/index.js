'use strict';

//Route names
import { CARRIER_HOME_ROUTE, EDIT_USER_CARRIER } from 'Constants/carriers/routes';
import EditUser from 'Components/views/general/EditUser';

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
  {
    name: EDIT_USER_CARRIER,
    path: 'edit',
    component: EditUser,
    meta: {
      public: false,
    }
  },
];

export default routes;