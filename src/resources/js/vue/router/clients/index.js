'use strict';

//Route names
import { CLIENT_HOME_ROUTE } from 'Constants/clients/routes';

//Components
import Home from 'Components/views/clients/Home';


const routes = [
  {
    path: '/',
    redirect: { name: CLIENT_HOME_ROUTE },
    meta: {
      public: false,
    },
  },
  {
    name: CLIENT_HOME_ROUTE,
    path: 'home',
    component: Home,
    meta: {
      public: false,
    }
  },
];

export default routes;