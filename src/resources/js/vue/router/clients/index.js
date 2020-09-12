'use strict';

//Route names
import { CLIENT_HOME_ROUTE } from 'Constants/clients/routes';

//Components
import Home from 'Components/views/clients/Home';


const routes = [
  {
    path: '/',
    redirect: { name: CLIENT_HOME_ROUTE }
  },
  {
    name: CLIENT_HOME_ROUTE,
    path: 'home',
    component: Home,
  },
];

export default routes;