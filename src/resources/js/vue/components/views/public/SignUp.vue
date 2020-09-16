<template>
  <div class="register-view">
    <img
      class="background"
      src="/images/register-background.png"/>
    <div class="register-form px-3">
      <div class="header px-3">
        <p class="mb-0">
          Únete a miFlete
        </p>

        <img
          class="logo img img-fluid ml-auto"
          src="/images/logotext.png"/>
      </div>
      <div class="selector px-3">
        <p class="mb-1 description">
          Soy un:
        </p>
        <div class="buttons w-100">
          <button class="btn mt-1"
                  :class="[form['is_client'] ? 'secondary' : 'default']"
                  @click="selectClient">
            <font-awesome-icon :icon="['far', 'user']"/>
            <br/>
            Cliente
          </button>

          <button class="btn mt-1"
                  :class="[form['is_client'] ? 'default' : 'secondary']"
                  @click="selectCarrier">
            <font-awesome-icon :icon="['fas', 'truck']"/>
            <br/>
            Transportista
          </button>
        </div>
      </div>
      <ValidationObserver v-slot="{ invalid }">
        <form class="form row mx-0"
              @submit.prevent="onSubmit">
          <div class="form-group col-12 col-md-6">
            <ValidationProvider v-slot="{ errors }"
                                name="nombres"
                                rules="required">
              <label for="nombres">
                Nombres *
              </label>
              <input id="nombres"
                     v-model="form['first_name']"
                     type="text"
                     class="form-control"
                     :class="{ 'has-errors': errors.length }"/>
              <span class="red-text">
                {{ errors[0] }}
              </span>
            </ValidationProvider>
          </div>

          <div class="form-group col-12 col-md-6">
            <ValidationProvider v-slot="{ errors }"
                                name="apellidos"
                                rules="required">
              <label for="nombres">
                Apellidos *
              </label>
              <input id="apellidos"
                     v-model="form['last_name']"
                     type="text"
                     class="form-control"
                     :class="{ 'has-errors': errors.length }"/>
              <span class="red-text">
                {{ errors[0] }}
              </span>
            </ValidationProvider>
          </div>

          <div class="form-group col-12 col-md-6">
            <ValidationProvider v-slot="{ errors }"
                                name="email"
                                rules="required|email">
              <label for="email">
                Email *
              </label>
              <input id="email"
                     v-model="form.email"
                     type="text"
                     class="form-control"
                     :class="{ 'has-errors': errors.length }"/>
              <span class="red-text">
                {{ errors[0] }}
              </span>
            </ValidationProvider>
          </div>

          <div class="form-group col-12 col-md-6">
            <ValidationProvider v-slot="{ errors }"
                                name="telefono"
                                rules="">
              <label for="telefono">
                Teléfono
              </label>
              <input id="telefono"
                     v-model="form['phone_number']"
                     type="text"
                     class="form-control"
                     :class="{ 'has-errors': errors.length }"/>
              <span class="red-text">
                {{ errors[0] }}
              </span>
            </ValidationProvider>
          </div>

          <div class="form-group col-12 col-md-6">
            <ValidationProvider v-slot="{ errors }"
                                vid="contrasena"
                                name="contrasena"
                                rules="required">
              <label for="contrasena">
                Contraseña *
              </label>
              <input id="contrasena"
                     v-model="form.password"
                     type="password"
                     class="form-control"
                     :class="{ 'has-errors': errors.length }"/>
              <span class="red-text">
                {{ errors[0] }}
              </span>
            </ValidationProvider>
          </div>

          <div class="form-group col-12 col-md-6">
            <ValidationProvider v-slot="{ errors }"
                                name="contrasena_conf"
                                rules="required|confirmed:contrasena">
              <label for="contrasena_conf">
                Confirme contraseña *
              </label>
              <input id="contrasena_conf"
                     v-model="form['confirm_password']"
                     type="password"
                     class="form-control"
                     :class="{ 'has-errors': errors.length }"/>
              <span class="red-text">
                {{ errors[0] }}
              </span>
            </ValidationProvider>
          </div>

          <div class="form-group col-12 text-center">
            <button class="btn primary mb-1"
                    type="submit"
                    :disabled="invalid || fetching">
              Crear cuenta
            </button>

            <p class="mb-0 go-login">
              ¿Ya tienes una cuenta?

              <router-link exact
                           class="link"
                           :to="{ name: login }">
                Ingresa
              </router-link>
            </p>
          </div>
        </form>
      </ValidationObserver>
    </div>
  </div>
</template>

<script>
  import helpers from 'Base/utils/helpers';
  import { getHomePage } from 'Base/utils/redirects';
  import  { LOGIN_ROUTE } from 'Constants/general/routes';

  export default {
    data () {
      return {
        form: {
          is_client: true,
          first_name: '',
          last_name: '',
          email: '',
          phone_number: '',
          password: '',
          confirm_password: '',
        },
        fetching: false,
        login: LOGIN_ROUTE,
      }
    },

    methods: {
      onSubmit () {
        this.fetching = true;

        this.$store.dispatch('users/register', this.form)
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
          });
      },

      selectClient () {
        this.form['is_client'] = true;
      },

      selectCarrier () {
        this.form['is_client'] = false;
      },
    },
  }
</script>

<style lang="scss">
  @import 'Assets/_variables.scss';
  @import 'Assets/_mixins.scss';
  @import 'Assets/_buttons.scss';
  @import 'Assets/_background';
  @import 'Assets/utils/_breakpoints';

  .register-view {
    @include flex(row, center, center, wrap);
    height: 100%;

    .background {
      @include background();
    }

    .register-form {
      @include flex(column, center, center, wrap);
      width: 33%;
      background: $white;
      z-index: 1;
      opacity: 1;
      border-radius: $radius;

      @include media-breakpoint-down(xl) {
        width: 45%;
      }

      @include media-breakpoint-down(lg) {
        width: 60%;
      }

      @include media-breakpoint-down(md) {
        width: 80%;
      }

      .header {
        @include flex(row, center, center, wrap);
        margin-top: 1rem;
        width: 100%;

        @include media-breakpoint-down(sm) {
          font-size: 1.5rem;
        }

        .logo {
          width: 3.5rem;
        }
      }

      .selector {
        @include flex(row, center, flex-start, wrap);
        width: 100%;

        .buttons {
          @include flex(row, center, space-between, wrap);
          .btn {
            height: 4rem;
            width: 48%;

            @include media-breakpoint-down(sm) {
              width: 100%;
            }
          }

          .description {
            font-size: 0.8rem;
          }
        }
      }

      .form {
        width: 100%;

        .go-login {
          font-size: 0.7rem;
          color: $grey;

          @include media-breakpoint-down(md) {
            font-size: 1rem;
            margin-top: 1rem;
          }

          .link {
            text-decoration: underline;
          }
        }
      }
    }
  }
</style>