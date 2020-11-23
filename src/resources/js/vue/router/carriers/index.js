'use strict';

//Route names
import { CARRIER_HOME_ROUTE, EDIT_USER_CARRIER, CARRIER_REQUESTS_ROUTE, CARRIER_REPLY_CREATE } from 'Constants/carriers/routes';
import EditUser from 'Components/views/general/EditUser';
import Requests from 'Components/views/carriers/Requests';
import CreateReply from 'Components/views/carriers/NewReply';

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
  {
    name: CARRIER_REQUESTS_ROUTE,
    path: 'requests',
    component: Requests,
    meta: {
      public: false,
    }
  },
  {
    name: CARRIER_REPLY_CREATE,
    path: 'requests/:id/replies/create',
    component: CreateReply,
    meta: {
      public: false,
    }
  },
];

export default routes;