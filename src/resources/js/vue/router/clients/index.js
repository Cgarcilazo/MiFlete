'use strict';

//Route names
import { CLIENT_HOME_ROUTE, CLIENT_REQUESTS_ROUTE, CLIENT_NEW_REQUEST_ROUTE } from 'Constants/clients/routes';
import { EDIT_USER } from 'Constants/general/routes';

//Components
import Home from 'Components/views/clients/Home';
import Requests from 'Components/views/clients/Requests';
import NewRequest from 'Components/views/clients/NewRequest';
import EditUser from 'Components/views/general/EditUser';


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
  {
    name: CLIENT_NEW_REQUEST_ROUTE,
    path: 'new-request',
    component: NewRequest,
    meta: {
      public: false,
    }
  },
  {
    name: EDIT_USER,
    path: 'edit',
    component: EditUser,
    meta: {
      public: false,
    }
  },
];

export default routes;