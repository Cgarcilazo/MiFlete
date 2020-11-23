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

    <div class="edit-user-form px-3 pt-3">
      <ValidationObserver v-slot="{ invalid }">
        <form class="form row mx-0"
              @submit.prevent="onSubmit">
          <div class="form-group col-12 col-md-6">
            <ValidationProvider v-slot="{ errors }"
                                name="nombres"
                                rules="required">
              <label for="nombres">
                Nombres
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
                Apellidos
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
                Email
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
                                rules="">
              <label for="contrasena">
                Nueva contraseña
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
                                :rules="{ required:form.password != '', confirmed: 'contrasena' }">
              <label for="contrasena_conf">
                Confirme contraseña
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
              Guardar
            </button>

            <button class="btn outline mb-1"
                    type="submit"
                    :disabled="invalid || fetching"
                    @click="goToHomePage">
              Cancelar
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
  import { mapGetters } from 'vuex';

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

    computed: {
      ...mapGetters('users', [
        'getUser',
      ]),
    },

    created () {
      this.initFormData();
    },

    methods: {
      onSubmit () {
        this.fetching = true;

        this.$store.dispatch('users/edit', this.form)
          .then(response => {
            this.$toast.success(response.data.message);
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

      initFormData () {
        this.form.is_client = this.getUser.is_client || true;
        this.form.first_name = this.getUser.first_name || '';
        this.form.last_name = this.getUser.last_name || '';
        this.form.email = this.getUser.email || '';
        this.form.phone_number = this.getUser.phone_number || '';
        this.form.password = this.getUser.password || '';
        this.form.confirm_password = this.getUser.confirm_password || '';
      },

      goToHomePage () {
        this.$router.push(getHomePage());
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
      margin-top: 3rem;

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

        .primary {
          margin-right: 15px;
        }

        .outline {
          margin-left: 15px;
        }
      }
    }
  }
</style>