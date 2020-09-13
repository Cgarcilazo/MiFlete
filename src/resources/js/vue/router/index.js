import Vue from 'vue'
import Router from 'vue-router'
import multiguard from 'vue-router-multiguard';

// Public views
import SignUp from 'Components/views/public/SignUp'
import Landing from 'Components/views/public/Landing'
import Login from 'Components/views/public/Login'

// Client views
import ClientRoutes from 'Base/router/clients';
import ClientDashboard from 'Components/views/clients/Dashboard';

// Carrier views
import CarrierRoutes from 'Base/router/carriers';
import CarrierDashboard from 'Components/views/carriers/Dashboard';

//General Routes
import { LANDING_ROUTE, LOGIN_ROUTE, SIGN_UP_ROUTE } from 'Constants/general/routes';

//Middlewares
import { fetchUser, isPublicRoute, isPrivateRoute, onlyForClients, onlyForCarriers } from 'Base/middlewares';

Vue.use(Router);

const router = new Router({
  mode: 'history',
  routes: [
    // public routes
    {
      path: '/',
      name: LANDING_ROUTE,
      component: Landing,
      meta: {
        public: true,
      },
    },
    {
      path: '/login',
      name: LOGIN_ROUTE,
      component: Login,
      meta: {
        public: true,
      },
    },
    {
      path: '/signup',
      name: SIGN_UP_ROUTE,
      component: SignUp,
      meta: {
        public: true,
      },
    },
    {
      path: '/clients',
      component: ClientDashboard,
      children: ClientRoutes,
      beforeEnter: multiguard([onlyForClients]),
      meta: {
        public: false,
      },
    },
    {
      path: '/carriers',
      component: CarrierDashboard,
      children: CarrierRoutes,
      beforeEnter: multiguard([onlyForCarriers]),
      meta: {
        public: false,
      },
    },
  ]
});

router.beforeEach(multiguard([fetchUser, isPublicRoute, isPrivateRoute]));

export default router;