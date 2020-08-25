import Vue from 'vue'
import Router from 'vue-router'
// Public views
import SignUp from 'Components/views/public/SignUp'
import Landing from 'Components/views/public/Landing'
import Login from 'Components/views/public/Login'

// Client views

// Carrier views

Vue.use(Router);

export const router = new Router({
  mode: 'history',
  routes: [
    // public routes
    {
      path: '/',
      name: 'Landing',
      component: Landing
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/signup',
      name: 'SignUp',
      component: SignUp
    },
  ]
});
