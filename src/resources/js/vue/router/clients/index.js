'use strict';

//Route names
import { CLIENT_HOME_ROUTE, CLIENT_REQUESTS_ROUTE, CLIENT_NEW_REQUEST_ROUTE, EDIT_USER_CLIENT, CLIENT_REPLIES, CLIENT_DETAIL_REQUEST_ROUTE, CLIENT_REQUEST_EDIT_ROUTE } from 'Constants/clients/routes';

//Components
import Home from 'Components/views/clients/Home';
import Requests from 'Components/views/clients/Requests';
import NewRequest from 'Components/views/clients/NewRequest';
import EditUser from 'Components/views/general/EditUser';
import Replies from 'Components/views/clients/Replies';
import RequestDetails from 'Components/views/clients/RequestDetails';
import RequestEdit from 'Components/views/clients/EditRequest';


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
    name: CLIENT_REPLIES,
    path: 'requests/:id/replies',
    component: Replies,
    meta: {
      public: false,
    }
  },
  {
    name: CLIENT_DETAIL_REQUEST_ROUTE,
    path: 'requests/:id',
    component: RequestDetails,
    meta: {
      public: false,
    }
  },
  {
    name: CLIENT_REQUEST_EDIT_ROUTE,
    path: 'requests/:id/edit',
    component: RequestEdit,
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
    name: EDIT_USER_CLIENT,
    path: 'edit',
    component: EditUser,
    meta: {
      public: false,
    }
  },
];

export default routes;