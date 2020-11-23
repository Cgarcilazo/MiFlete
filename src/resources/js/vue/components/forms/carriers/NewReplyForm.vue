<template>
  <div class="row no-gutters justify-content-center align-items-center">
    <Loader v-if="loading"/>

    <div
      v-else
      class="form">
      <div class="row">
        <h4 class="col-12 text-center">
          Usted está a punto de realizar una oferta a la siguiente solicitud:
        </h4>
        <div class="from col-6">
          <h4>Origen</h4>
          <div class="block-form">
            <div class="validator-provider">
              <label for="provincia-desde">
                Provincia: {{ request['province_origin'] }}
              </label>
            </div>
            <div
              class="validator-provider mt-2">
              <label for="ciudad-desde">
                Ciudad: {{ request['city_origin'] }}
              </label>
            </div>
            <div
              class="mt-2">
              <label for="calle-desde">
                Calle: {{ request['street_origin'] }}
              </label>
            </div>
            <div class="row no-gutters address-info mt-2">
              <span>
                <label for="numero-desde">
                  Nro: {{ request['street_number_origin'] }}
                </label>
              </span>
              <span>
                <label for="piso-desde">
                  Piso: {{ request['flat_number_origin'] || '-' }}
                </label>
              </span>
              <span>
                <label for="departamento-desde">
                  Dpto: {{ request['flat_letter_origin'] || '-' }}
                </label>
              </span>
            </div>
            <div
              class="mt-2">
              <label for="fecha">
                Fecha: {{ request.date }}
              </label>
            </div>
            <div
              class="mt-2">
              <label>
                Hora preferencial: {{ request.preferred_hour }}
              </label>
            </div>
            <div
              class="mt-2">
              <label>
                Rango horario: desde {{ request.range_hour_from || '-' }} - hasta {{ request.range_hour_to || '-' }}
              </label>
            </div>
          </div>
        </div>
        <div class="to col-6">
          <h4>Destino</h4>
          <div class="block-form">
            <div
              class="validator-provider">
              <label for="provincia-hasta">
                Provincia: {{ request['province_destination'] }}
              </label>
            </div>
            <div
              class="validator-provider mt-2">
              <label for="ciudad-hasta">
                Ciudad: {{ request['city_destination'] }}
              </label>
            </div>
            <div
              class="mt-2">
              <label for="calle-hasta">
                Calle: {{ request['street_destination'] }}
              </label>
            </div>
            <div class="row no-gutters address-info mt-2">
              <span>
                <label for="numero-hasta">
                  Nro: {{ request['street_number_destination'] }}
                </label>
              </span>
              <span>
                <label for="piso-hasta">
                  Piso: {{ request['flat_number_destination'] }}
                </label>
              </span>
              <span>
                <label for="departamento-hasta">
                  Dpto: {{ request['flat_letter_destination'] }}
                </label>
              </span>
            </div>
          </div>
        </div>
      </div>
      <div>
        <h4 class="mt-4">
          Descripción de la carga
        </h4>
        <div class="block-form">
          <div class="validator-provider">
            <div class="input-group disabled">
              <textarea
                v-model="request.description"
                class="form-control"
                disabled></textarea>
            </div>
          </div>
        </div>
        <h4 class="mt-4">
          Detalles adicionales
        </h4>
        <div class="block-form">
          <div class="form-group">
            <label
              class="form-check-label"
              for="operarios">Se precisan dos o más operarios: {{ request['need_more_carriers'] ? 'Si' : 'No' }}</label>
          </div>

          <label for="ascensor-origen">
            ¿Hay ascensor en origen?: {{ request['is_elevator_origin'] ? 'Si' : 'No' }}
          </label>
          <div class="ascensor-radio mt-2">
            <label for="ascensor-destination">
              ¿Hay ascensor en destino?: {{ request['is_elevator_destination'] ? 'Si' : 'No' }}
            </label>
          </div>
          <div
            class="validator-provider mt-2">
            <label for="aclaraciones">
              Instrucciones o aclaraciones importantes:
            </label>
            <div class="input-group disabled">
              <textarea
                id="aclaraciones"
                v-model="request.clarifications"
                class="form-control"
                disabled></textarea>
            </div>
          </div>
        </div>
      </div>
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
  import { CARRIER_REQUESTS_ROUTE } from 'Constants/carriers/routes';
  import helpers from 'Base/utils/helpers';
  import { mapState } from 'vuex';
  import Loader from 'Components/resources/Loader';

  export default {
    components: {
      Loader,
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

      onSubmit () {
        this.saving = true
        this.payload.requestId = this.request.id || null;
        this.$store.dispatch('replies/create', this.payload)
          .then(() => {
            this.$toast.success('Oferta creada correctamente');
            this.goBack();
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