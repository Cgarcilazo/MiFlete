<template>
  <div>
    <div class="row">
      <nav
        class="navbar navbar-expand-lg bg-light">
        <img
          class="logo"
          src="/images/logotext.png"
          height="80"/>
        <div v-if="!isAuthenticated"
             class="navbar-items ml-auto">
          <router-link
            class="nav-item"
            exact
            :to="{ name: signUp }">
            <font-awesome-icon
              class="navbar-icon"
              icon="user-plus"
              size="1x"/>
            <h5>Registrarse</h5>
          </router-link>
          <router-link
            class="nav-item"
            exact
            :to="{ name: login }">
            <font-awesome-icon
              class="navbar-icon"
              icon="sign-in-alt"
              size="1x"/>
            <h5>Entrar</h5>
          </router-link>
        </div>
        <div v-if="isAuthenticated && isClient"
             class="navbar-items ml-auto">
          <router-link
            class="nav-item"
            exact
            :to="{ name: clientHome }">
            <font-awesome-icon
              class="navbar-icon"
              icon="home"
              size="1x"/>
            <h5>Inicio</h5>
          </router-link>
          <router-link
            class="nav-item"
            exact
            :to="{ name: landing }">
            <font-awesome-icon
              class="navbar-icon"
              icon="truck"
              size="1x"/>
            <h5>Solicitudes</h5>
          </router-link>
        </div>
        <div v-if="isAuthenticated && isCarrier"
             class="navbar-items ml-auto">
          <router-link
            class="nav-item"
            exact
            :to="{ name: carrierHome }">
            <font-awesome-icon
              class="navbar-icon"
              icon="home"
              size="1x"/>
            <h5>Inicio</h5>
          </router-link>
          <router-link
            class="nav-item"
            exact
            :to="{ name: landing }">
            <font-awesome-icon
              class="navbar-icon"
              icon="clipboard-list"
              size="1x"/>
            <h5>Solicitudes</h5>
          </router-link>
          <router-link
            class="nav-item"
            exact
            :to="{ name: landing }">
            <font-awesome-icon
              class="navbar-icon"
              icon="sign-in-alt"
              size="1x"/>
            <h5>Ofertas realizadas</h5>
          </router-link>
          <router-link
            class="nav-item"
            exact
            :to="{ name: landing }">
            <font-awesome-icon
              class="navbar-icon"
              icon="check"
              size="1x"/>
            <h5>Envíos finalizados</h5>
          </router-link>
        </div>
        <UserMenu v-if="isAuthenticated"/>
      </nav>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import UserMenu from 'Components/UserMenu'
  import  { SIGN_UP_ROUTE, LOGIN_ROUTE, LANDING_ROUTE } from 'Constants/general/routes'
  import { CLIENT_HOME_ROUTE } from 'Constants/clients/routes';
  import { CARRIER_HOME_ROUTE } from 'Constants/carriers/routes';

  export default {
    components: { UserMenu },

    data () {
      return {
        signUp: SIGN_UP_ROUTE,
        login: LOGIN_ROUTE,
        landing: LANDING_ROUTE,
        clientHome: CLIENT_HOME_ROUTE,
        carrierHome: CARRIER_HOME_ROUTE
      }
    },

    computed: {
      ...mapGetters('users', ['isClient', 'isCarrier', 'isAuthenticated'])
    }
  }
</script>

<style lang="scss" >
  @import 'Assets/_variables.scss';
  @import 'Assets/_mixins.scss';

  .navbar {
    @include flex(row, center, space-between, wrap);
    padding: 0;
    position: absolute;
    right: 0;
    top: 0;
    width: 100%;
    z-index: 1;

    .logo {
      margin-left: 2rem;
    }

    .navbar-items {
      @include flex(row, center, space-between, wrap);

      .nav-item.router-link-active {
        background: $extra-light-blue;
        color: $white;
        padding: 2.5rem;

        .navbar-icon {
          color: $white;
        }
      }

      .nav-item {
        @include flex(row, center, space-between, wrap);
        font-size: 1.25em;
        color: $grey;
        text-decoration: none;
        padding: 2.5rem;

        h5 {
          margin: 0;
          font-weight: 400;
        }

        @media (max-width: 1380px) {
          padding: 37px 20px;
        }

        &:hover {
          background: $extra-light-blue;
          color: $white;
          padding: 2.5rem;

          .navbar-icon {
            color: $white;
          }
        }

        .navbar-icon {
          margin-right: 1rem;
          color: $grey;
        }
      }
    }
  }
</style>

