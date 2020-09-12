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

//Middlewares
import middlewares from 'Base/pepito/pepito';

Vue.use(Router);

const router = new Router({
  mode: 'history',
  routes: [
    // public routes
    {
      path: '/',
      name: 'landing',
      component: Landing,
      meta: {
        public: true,
      },
    },
    {
      path: '/login',
      name: 'login',
      component: Login,
      meta: {
        public: true,
      },
    },
    {
      path: '/signup',
      name: 'signUp',
      component: SignUp,
      meta: {
        public: true,
      },
    },
    {
      path: '/clients',
      component: ClientDashboard,
      children: ClientRoutes,
      meta: {
        public: false,
      },
    },
    {
      path: '/carriers',
      component: CarrierDashboard,
      children: CarrierRoutes,
      meta: {
        public: false,
      },
    },
  ]
});

router.beforeEach(multiguard([middlewares.pepito]));

export default router;