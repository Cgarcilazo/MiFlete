<template>
  <div class="login-view">
    <img
      class="background"
      src="/images/register-background.png"/>
    <div class="login-block">
      <img
        class="logo"
        src="/images/logotext.png"/>
      <ValidationObserver v-slot="{ invalid }"
                          slim>
        <div class="login-form">
          <ValidationProvider v-slot="{ errors }"
                              tag="div"
                              name="email"
                              class="validator-provider"
                              rules="required">
            <div class="input-group">
              <input v-model="form.email"
                     type="email"
                     class="form-control"
                     :class="{ 'has-errors': errors.length }"
                     placeholder="Email"/>
              <div class="input-group-append">
                <font-awesome-icon :icon="['far', 'envelope']"/>
              </div>
            </div>
            <span class="red-text">
              {{ errors[0] }}
            </span>
          </ValidationProvider>
          <ValidationProvider v-slot="{ errors }"
                              slim
                              name="email"
                              class="validator-provider"
                              rules="required">
            <div class="input-group">
              <input v-model="form.password"
                     type="password"
                     class="form-control"
                     :class="{ 'has-errors': errors.length }"
                     placeholder="Contraseña"/>
              <div class="input-group-append">
                <font-awesome-icon :icon="['fas', 'key']"/>
              </div>
            </div>
            <span class="red-text">
              {{ errors[0] }}
            </span>
          </ValidationProvider>
          <button class="btn primary mb-1"
                  :disabled="invalid || fetching"
                  @click="login">
            Login
          </button>

          <p class="mb-0 go-register">
            ¿Todavía no tienes una cuenta?

            <router-link exact
                         class="link"
                         :to="{ name: signUp }">
              Regístrate
            </router-link>
          </p>
        </div>
      </ValidationObserver>
    </div>
  </div>
</template>

<script>
  import helpers from 'Base/utils/helpers';
  import { getHomePage } from 'Base/utils/redirects';
  import  { SIGN_UP_ROUTE } from 'Constants/general/routes';

  export default {
    data () {
      return {
        form: {
          email: '',
          password: '',
        },
        fetching: false,
        signUp: SIGN_UP_ROUTE,
      }
    },

    methods: {
      login () {
        this.fetching = true;

        this.$store.dispatch('users/login', this.form)
          .then(response => {
            this.$router.replace(getHomePage());
          })
          .catch(error => {
            if (error.response.data.data.errors != null) {
              let errorList = helpers.handleResponseErrors(error.response.data.data.errors);
              this.$toast.error(errorList[0]);
            } else {
              this.$toast.error(error.response.data.error);
            }
          })
          .finally(() => {
            this.fetching = false;
          })
      }
    },
  }
</script>

<style lang="scss">
@import 'Assets/_variables.scss';
@import 'Assets/_mixins.scss';
@import 'Assets/_buttons.scss';
@import 'Assets/_background';
@import 'Assets/utils/_breakpoints';

.login-view {
  @include flex(column, center, center, wrap);
  color: $green;
  height: 100vh;

  .background {
    @include background();
  }

  .login-block {
    @include flex(column, center, space-between, wrap);
    background-color: $white;
    padding: 20px;
    width: 25%;
    border-radius: $radius;
    position: relative;
    z-index: 10;

    @include media-breakpoint-down(xl) {
      width: 40%;
    }

    @include media-breakpoint-down(lg) {
      width: 40%;
    }

    @include media-breakpoint-down(md) {
      width: 50%;
    }

    @include media-breakpoint-down(sm) {
      width: 80%;
    }

    .logo {
      width: 10rem;
      margin: 2rem;
    }

    .login-form {
      @include flex(column, center, space-between, wrap);
      margin: 2rem 0;

      .validator-provider {
        @include flex(column, left, space-between, wrap);
        margin-bottom: 2rem;
      }

      .input-group {
        border: 1px solid $light-grey;
        border-radius: $radius;

        .form-control {
          &:focus {
            box-shadow: none;
          }
        }

        .input-group-append {
          background-color: $light-blue;
          border-radius: 0 $radius $radius 0;
          color: $grey;
          padding: 10px;
        }
      }

      .go-register {
        font-size: 0.7rem;
        color: $grey;

        .link {
          text-decoration: underline;
        }
      }
    }
  }
}
</style>