<template>
  <div
    id="account"
    class="d-flex flex-row align-items-center">
    <img
      alt="Avatar"
      class="avatar round"
      src="/images/profile.png"/>
    <div class="d-flex flex-column justify-content-start">
      <div class="dropdown user-dropdown">
        <button
          id="dropdownMenuButton"
          class="btn btn-secondary dropdown-toggle"
          type="button"
          data-toggle="dropdown"
          aria-haspopup="true"
          aria-expanded="false">
          {{ getUser.first_name }}
          <font-awesome-icon
            class="dropdown-icon"
            :icon="'angle-right'"
            rotation="90"/>
        </button>
        <div
          class="dropdown-menu dropdown-menu-right py-0"
          aria-labelledby="dropdownMenuButton">
          <div
            class="my-2 dropdown-item p-2">
            <font-awesome-icon
              :icon="'edit'"/>
            <span class="ml-2">Editar</span>
          </div>

          <div
            class="my-2 dropdown-item p-2"
            @click="logout">
            <font-awesome-icon
              :icon="'sign-out-alt'"
              rotation="180"/>
            <span class="ml-2">Salir</span>
          </div>
        </div>
      </div>

      <p class="user-type">
        {{ isClient ? 'Cliente' : 'Transportista' }}
      </p>
    </div>
  </div>
</template>

<script>

  import { mapGetters } from 'vuex'

  export default {
    computed: {
      ...mapGetters('users', ['isClient', 'getUser']),
    },

    methods: {
      logout () {
        this.$store.commit('users/logout');
      }
    }
  }
</script>

<style lang="scss">
@import 'Assets/_variables.scss';
  #account {
    cursor: default;

    .avatar {
      width: 50px;
      height: 50px;
      margin: 0 8px;
    }

    .user-dropdown {

      .dropdown-toggle {
        background: none;
        border: none;
        font-weight: $bold;
        color: $grey;
        font-size: 20px;
        padding: 0;
        text-align: left;

        &:focus {
          box-shadow: none;
        }
      }

      .dropdown-toggle::after {
        display: none !important;
      }

      .dropdown-icon {
        margin-left: 8px;
      }

      .dropdown-menu.show {
        margin-top: 30px;
        min-width: 9rem;

        .dropdown-item {
          text-decoration: none;
          max-width: 9rem;
          color: $grey;

          &:hover {
            background-color: $light-blue;
            color: $white;
          }
        }
      }
    }

    .user-type {
      margin: 0;
      align-self: baseline;
      color: $light-blue;
    }
  }
</style>
