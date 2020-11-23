<template>
  <div class="row no-gutters justify-content-center align-items-center">
    <Loader v-if="loading"/>

    <div
      v-else
      class="form col-12">
      <h4 class="col-12 text-center">
        Usted está a punto de realizar una oferta a la siguiente solicitud:
      </h4>
      <RequestDetails :request="request"/>
      <ValidationObserver
        v-slot="{ invalid }"
        tag="form"
        @submit.prevent="onSubmit">
        <div>
          <h4 class="mt-4">
            Ofertar Presupuesto
          </h4>

          <div class="block-form">
            <ValidationProvider
              v-slot="{ errors }"
              tag="div"
              name="monto"
              class="validator-provider"
              rules="required|decimal">
              <label for="monto">
                Monto a ofertar *
              </label>
              <div class="input-group">
                <span class="mt-2 mr-2">
                  $
                </span>
                <input
                  id="monto"
                  v-model="payload.price"
                  type="text"
                  class="form-control"
                  :class="{ 'has-errors': errors.length }"
                  placeholder="Ingrese el monto que considere correcto"/>
              </div>
              <span class="red-text ml-3">
                {{ errors[0] }}
              </span>
            </ValidationProvider>

            <ValidationProvider
              v-slot="{ errors }"
              tag="div"
              name="descripcion"
              class="validator-provider mt-4"
              rules="">
              <label for="descripcion">
                Aclaraciones
              </label>
              <div class="input-group">
                <textarea
                  id="descripcion"
                  v-model="payload.description"
                  class="form-control"
                  :class="{ 'has-errors': errors.length }"></textarea>
              </div>
              <span class="red-text">
                {{ errors[0] }}
              </span>
            </ValidationProvider>
          </div>
        </div>
        <div class="d-flex my-5 justify-content-center">
          <button
            type="submit"
            :disabled="invalid || saving"
            class="btn primary mx-3">
            Ofertar
          </button>
          <button
            type="button"
            class="btn outline mx-3"
            @click="goBack()">
            Cancelar
          </button>
        </div>
      </ValidationObserver>
    </div>
  </div>
</template>

<script>
  import { CARRIER_REQUESTS_ROUTE, CARRIER_REPLIES_ROUTE } from 'Constants/carriers/routes';
  import helpers from 'Base/utils/helpers';
  import { mapState } from 'vuex';
  import Loader from 'Components/resources/Loader';
  import RequestDetails from 'Components/forms/carriers/RequestDetails';

  export default {
    components: {
      Loader,
      RequestDetails,
    },

    data() {
      return {
        payload: {
          price: '',
          description: '',
        },
        saving: false,
        loading: false,
      }
    },

    computed: {
      ...mapState('requests', [
        'request',
      ]),
    },

    created () {
      this.loading = true;
      this.$store.dispatch('requests/fetchById', this.$route.params.id)
        .catch((error) => {
          if (error.response.data.data.errors != null) {
            let errorList = helpers.handleResponseErrors(error.response.data.data.errors);
            this.$toast.error(errorList[0]);
          } else {
            this.$toast.error(error.response.data.error);
          }
        })
        .finally(() => this.loading = false);
    },

    methods: {
      goBack() {
        this.$router.push({ name: CARRIER_REQUESTS_ROUTE });
      },

      goToAllReplies () {
        this.$router.push({ name: CARRIER_REPLIES_ROUTE });
      },

      onSubmit () {
        this.saving = true
        this.payload.requestId = this.request.id || null;
        this.$store.dispatch('replies/create', this.payload)
          .then(() => {
            this.$toast.success('Oferta creada correctamente');
            this.goToAllReplies();
          })
          .catch((error) => {
            if (error.response.data.data.errors != null) {
              let errorList = helpers.handleResponseErrors(error.response.data.data.errors);
              this.$toast.error(errorList[0]);
            } else {
              this.$toast.error(error.response.data.error);
            }
          })
          .finally(() => this.saving = false )
      }
    }
  }
</script>

<style lang="scss">
  @import 'Assets/_variables.scss';

  .block-form {
    border: 1px solid $grey;
    border-radius: $radius;
    padding: 2rem 2.5rem;

    .address-info {
      flex-direction: row;
      justify-content: space-between;

      .input-group {
        width: 30%;
      }

      span {
        width: 30%;
      }
    }

    .ascensor-radio {
      display: flex;
      flex-direction: column;
    }

    .time-picker {
      .display-time {
        border-radius: $radius;
      }
    }

  }
</style>