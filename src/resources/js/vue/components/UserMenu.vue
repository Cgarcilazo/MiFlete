<template>
  <div
    id="account"
    class="d-flex flex-row align-items-center">
    <img
      alt="Avatar"
      class="avatar round"
      src="/images/profile.png"/>
    <div class="d-flex flex-column justify-content-start">
      <div class="user-dropdown">
        <button
          id="dropdownMenuButton"
          class="btn btn-secondary dropdown-toggle"
          type="button"
          data-toggle="dropdown"
          aria-haspopup="true"
          aria-expanded="false">
          FER
          <font-awesome-icon
            class="dropdown-icon"
            :icon="'angle-right'"
            rotation="90"/>
        </button>
        <div
          class="dropdown-menu"
          aria-labelledby="dropdownMenuButton">
          <div
            class="my-2">
            <font-awesome-icon
              :icon="'edit'"/>
            <span class="ml-2">Editar Cuenta</span>
          </div>

          <div
            class="my-2"
            @click="logout">
            <font-awesome-icon
              :icon="'sign-out-alt'"
              rotation="180"/>
            <span class="ml-2">Salir</span>
          </div>
        </div>
      </div>


      <p class="user-organization">
        {{ isClient ? 'Cliente' : 'Transportista' }}
      </p>
    </div>
  </div>
</template>

<script>
  import { mapActions, mapGetters } from 'vuex'

  export default {
    computed: {
      ...mapGetters('users', ['isClient']),

    },

    methods: {
      ...mapActions('users', ['logout'])
    }
  }
</script>

<style lang="scss">
@import 'Assets/_variables.scss';
  #account {
    cursor: default;
    margin-right: 2rem;

    .avatar {
      width: 50px;
      height: 50px;
      margin: 0 8px;
      margin: 0 24px 0 60px;
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
      }

      .dropdown-toggle::after {
        display: none !important;
        margin-left: 8px;
      }

      .dropdown-icon {
        margin-left: 8px;
      }

      .dropdown-menu.show {
        margin-top: 30px;

        .dropdown-item {
          text-decoration: none;
          font-weight: $bold;

          &:active {
            background-color: $white;
            color: $black;
          }
        }
      }
    }

    .user-organization {
      margin: 0;
      align-self: baseline;
      color: $light-blue;
    }
  }
</style>
