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
          <button class="btn primary"
                  :disabled="invalid || fetching"
                  @click="login">
            Login
          </button>
        </div>
      </ValidationObserver>
    </div>
  </div>
</template>

<script>
  import helpers from 'Base/utils/helpers';
  import { getHomePage } from 'Base/utils/redirects';

  export default {
    data () {
      return {
        form: {
          email: '',
          password: '',
        },
        fetching: false,
      }
    },

    methods: {
      login () {
        this.fetching = true;

        this.$store.dispatch('users/login', this.form)
          .then(response => {
            this.$toast.success(response.data.message);
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

.login-view {
  @include flex(column, center, center, wrap);
  color: $green;
  height: 100vh;

  .background {
    position: fixed;
    z-index: 0;
    opacity: .5;
    width: 100%;
  }

  .login-block {
    @include flex(column, center, space-between, wrap);
    background-color: $white;
    padding: 20px;
    width: 25%;
    border-radius: $radius;
    position: relative;
    z-index: 10;

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
          opacity: .3;
          padding: 10px;
        }
        }
    }
  }
}
</style>