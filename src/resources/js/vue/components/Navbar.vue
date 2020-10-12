<template>
  <div>
    <nav
      class="navbar navbar-expand-lg navbar-light bg-light">
      <img
        class="navbar-brand"
        src="/images/logotext.png"
        height="80"/>
      <button class="navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target="#navbaruser"
              aria-controls="navbaruser"
              aria-expanded="false"
              aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div
        v-if="!isAuthenticated"
        id="navbaruser"
        class="navbar-items ml-auto collapse navbar-collapse">
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link
              class="nav-link"
              exact
              :to="{ name: signUp }">
              <font-awesome-icon
                class="navbar-icon"
                icon="user-plus"
                size="1x"/>
              Registrarse
            </router-link>
          </li>
          <li class="nav-item">
            <router-link
              class="nav-link"
              exact
              :to="{ name: login }">
              <font-awesome-icon
                class="navbar-icon"
                icon="sign-in-alt"
                size="1x"/>
              Entrar
            </router-link>
          </li>
        </ul>
      </div>
      <div
        v-if="isAuthenticated && isClient"
        id="navbaruser"
        class="navbar-items ml-auto collapse navbar-collapse">
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link
              class="nav-link"
              exact
              :to="{ name: clientHome }">
              <font-awesome-icon
                class="navbar-icon"
                icon="home"
                size="1x"/>
              Inicio
            </router-link>
          </li>
          <li class="nav-item">
            <router-link
              class="nav-link"
              exact
              :to="{ name: clientRequests }">
              <font-awesome-icon
                class="navbar-icon"
                icon="truck"
                size="1x"/>
              Solicitudes
            </router-link>
          </li>
          <li class="user-menu">
            <UserMenu
              v-if="isAuthenticated"/>
          </li>
          <hr class="line"/>
          <li class="nav-item user-menu-sm"
              @click="editUser">
            <div class="nav-link">
              <font-awesome-icon
                class="navbar-icon"
                :icon="'edit'"/>
              <span class="ml-2">Editar Perfil</span>
            </div>
          </li>
          <li class="nav-item user-menu-sm">
            <div
              class="nav-link"
              @click="logout">
              <font-awesome-icon
                class="navbar-icon"
                :icon="'sign-out-alt'"
                rotation="180"/>
              <span class="ml-2">Salir</span>
            </div>
          </li>
        </ul>
      </div>
      <div
        v-if="isAuthenticated && isCarrier"
        id="navbaruser"
        class="navbar-items ml-auto collapse navbar-collapse">
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link
              class="nav-link"
              exact
              :to="{ name: carrierHome }">
              <font-awesome-icon
                class="navbar-icon"
                icon="home"
                size="1x"/>
              Inicio
            </router-link>
          </li>
          <li class="nav-item">
            <router-link
              class="nav-link"
              exact
              :to="{ name: landing }">
              <font-awesome-icon
                class="navbar-icon"
                icon="clipboard-list"
                size="1x"/>
              Solicitudes
            </router-link>
          </li>
          <li class="nav-item">
            <router-link
              class="nav-link"
              exact
              :to="{ name: landing }">
              <font-awesome-icon
                class="navbar-icon"
                icon="sign-in-alt"
                size="1x"/>
              Ofertas realizadas
            </router-link>
          </li>
          <li class="nav-item">
            <router-link
              class="nav-link"
              exact
              :to="{ name: landing }">
              <font-awesome-icon
                class="navbar-icon"
                icon="check"
                size="1x"/>
              Envíos finalizados
            </router-link>
          </li>
          <li class="user-menu">
            <UserMenu
              v-if="isAuthenticated"/>
          </li>
          <hr class="line"/>
          <li class="nav-item user-menu-sm"
              @click="editUser">
            <div class="nav-link">
              <font-awesome-icon
                class="navbar-icon"
                :icon="'edit'"/>
              <span class="ml-2">Editar Perfil</span>
            </div>
          </li>
          <li class="nav-item user-menu-sm">
            <div
              class="nav-link"
              @click="logout">
              <font-awesome-icon
                class="navbar-icon"
                :icon="'sign-out-alt'"
                rotation="180"/>
              <span class="ml-2">Salir</span>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import UserMenu from 'Components/UserMenu'
  import  { SIGN_UP_ROUTE, LOGIN_ROUTE, LANDING_ROUTE, EDIT_USER } from 'Constants/general/routes';
  import { CLIENT_HOME_ROUTE, CLIENT_REQUESTS_ROUTE } from 'Constants/clients/routes';
  import { CARRIER_HOME_ROUTE } from 'Constants/carriers/routes';
  import { getEditPage } from 'Base/utils/redirects';

  export default {
    components: { UserMenu },

    data () {
      return {
        signUp: SIGN_UP_ROUTE,
        login: LOGIN_ROUTE,
        landing: LANDING_ROUTE,
        clientHome: CLIENT_HOME_ROUTE,
        clientRequests: CLIENT_REQUESTS_ROUTE,
        carrierHome: CARRIER_HOME_ROUTE,
      }
    },

    computed: {
      ...mapGetters('users', ['isClient', 'isCarrier', 'isAuthenticated'])
    },

    methods: {
      logout () {
        this.$store.commit('users/logout');
      },

      editUser () {
        this.$router.push(getEditPage());
      },
    }
  }
</script>

<style lang="scss" >
  @import 'Assets/_variables.scss';
  @import 'Assets/mixins/_flex.scss';
  @import 'Assets/utils/_breakpoints';

  .navbar {
    padding: 0;
    width: 100%;
    position: fixed;
    z-index: 10;

    .navbar-brand {
      margin-left: 2rem;
    }

    .navbar-toggler {
      margin-right: 2rem;
    }

    .navbar-items {
      justify-content: flex-end;

      .nav-item {
        @include flex(row, center, space-between, wrap);
        font-size: 1.25em;
        color: $grey;
        text-decoration: none;

        .nav-link {
          color: $grey;
          padding: 2.5rem;

          @include media-breakpoint-down(lg) {
            @include flex(column, center, center, wrap);
            line-height: 2rem;
          }

          @include media-breakpoint-down(md) {
            @include flex(row, center, center, wrap);
            padding: 0;
          }

          &:hover, &.router-link-active {
            background: $extra-light-blue;
            color: $white;

            .navbar-icon {
              color: $white;
            }

            @include media-breakpoint-down(md) {
              background: none;
              color: $grey;

              .navbar-icon {
                color: $grey;
              }
            }
          }

          .navbar-icon {
            margin-right: 1rem;
            color: $grey;

            @include media-breakpoint-down(lg) {
              margin: 0;
            }

            @include media-breakpoint-down(md) {
              margin: 1rem;
            }
          }
        }
      }

      .nav-item.user-menu-sm {
        @include media-breakpoint-up(lg) {
          display: none;
        }
      }

      li {
        display: flex;
      }

      .user-menu {
        margin: 0 2rem;

        @include media-breakpoint-down(md) {
          display: none;
        }
      }

      hr {
        width: 95%;

        @include media-breakpoint-up(lg) {
          display: none;
        }
      }
    }
  }
</style>

