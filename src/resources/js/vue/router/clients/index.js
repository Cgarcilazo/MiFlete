'use strict';

//Route names
import { CLIENT_HOME_ROUTE, CLIENT_REQUESTS_ROUTE } from 'Constants/clients/routes';

//Components
import Home from 'Components/views/clients/Home';
import Requests from 'Components/views/clients/Requests';


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
  {
    name: CLIENT_REQUESTS_ROUTE,
    path: 'requests',
    component: Requests,
    meta: {
      public: false,
    }
  },
];

export default routes;