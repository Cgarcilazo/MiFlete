<template>
  <div class="edit-user">
    <div class="title w-100 mb-3">
      <img
        class="background"
        src="/images/client-home-background.jpg"/>
      <h2 class="page-title">
        Editar datos
      </h2>
    </div>

    <div class="edit-user-form px-3">
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
              Editar
            </button>
          </div>
        </form>
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
          is_client: true,
          first_name: '',
          last_name: '',
          email: '',
          phone_number: '',
          password: '',
          confirm_password: '',
        },
        fetching: false,
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
    },
  }
</script>

<style lang="scss">
  @import 'Assets/_variables.scss';
  @import 'Assets/mixins/_flex.scss';
  @import 'Assets/_buttons.scss';
  @import 'Assets/utils/_breakpoints';
  @import 'Assets/mixins/_background';

  .edit-user {
    @include flex(row, center, center, wrap);

    .title {
      @include flex(column, center, center, wrap);
      height: 8rem;

      .background {
        @include background(absolute);
        height: 8rem;
      }

      .page-title {
        z-index: 1;
        position: absolute;
        font-weight: $bold;
      }
    }

    .edit-user-form {
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
        @include flex(row, center, left, wrap);
        margin-top: 1rem;
        width: 100%;

        @include media-breakpoint-down(sm) {
          font-size: 1.5rem;
        }

        .logo {
          width: 3.5rem;
        }
      }

      .form {
        width: 100%;
      }
    }
  }
</style>