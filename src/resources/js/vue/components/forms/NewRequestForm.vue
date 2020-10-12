<template>
  <ValidationObserver
    v-slot="{ invalid }"
    tag="form"
    @submit.prevent="onSubmit">
    <div class="row">
      <div class="from col-6">
        <h2>Desde</h2>
        <div class="block-form">
          <ValidationProvider
            v-slot="{ errors }"
            tag="div"
            name="provincia-desde"
            class="validator-provider"
            rules="required">
            <label for="provincia-desde">
              Provincia *
            </label>
            <div class="input-group">
              <input
                id="provincia-desde"
                v-model="payload['province_origin']"
                type="text"
                class="form-control"
                :class="{ 'has-errors': errors.length }"
                placeholder="Seleccionar Provincia"/>
            </div>
            <span class="red-text">
              {{ errors[0] }}
            </span>
          </ValidationProvider>
          <ValidationProvider
            v-slot="{ errors }"
            tag="div"
            name="ciudad-desde"
            class="validator-provider mt-4"
            rules="required">
            <label for="ciudad-desde">
              Ciudad *
            </label>
            <div class="input-group">
              <input
                id="ciudad-desde"
                v-model="payload['city_origin']"
                type="text"
                class="form-control"
                :class="{ 'has-errors': errors.length }"
                placeholder="Seleccionar Ciudad"/>
            </div>
            <span class="red-text">
              {{ errors[0] }}
            </span>
          </ValidationProvider>
          <ValidationProvider
            v-slot="{ errors }"
            tag="div"
            name="calle-desde"
            class="mt-4"
            rules="required">
            <label for="calle-desde">
              Calle *
            </label>
            <input
              id="calle-desde"
              v-model="payload['street_origin']"
              type="text"
              class="form-control"
              :class="{ 'has-errors': errors.length }"/>
            <span class="red-text">
              {{ errors[0] }}
            </span>
          </ValidationProvider>
          <div class="row no-gutters address-info mt-4">
            <ValidationProvider
              v-slot="{ errors }"
              name="numero-desde"
              rules="required">
              <label for="numero-desde">
                Nro. *
              </label>
              <input
                id="numero-desde"
                v-model="payload['street_number_origin']"
                type="text"
                class="form-control"
                :class="{ 'has-errors': errors.length }"/>
              <span class="red-text">
                {{ errors[0] }}
              </span>
            </ValidationProvider>
            <ValidationProvider
              v-slot="{ errors }"
              name="piso-desde"
              rules="">
              <label for="piso-desde">
                Piso
              </label>
              <input
                id="piso-desde"
                v-model="payload['flat_number_origin']"
                type="text"
                class="form-control"
                :class="{ 'has-errors': errors.length }"/>
              <span class="red-text">
                {{ errors[0] }}
              </span>
            </ValidationProvider>
            <ValidationProvider
              v-slot="{ errors }"
              name="departamento-desde"
              rules="">
              <label for="departamento-desde">
                Dpto.
              </label>
              <input
                id="departamento-desde"
                v-model="payload['flat_letter_origin']"
                type="text"
                class="form-control"
                :class="{ 'has-errors': errors.length }"/>
              <span class="red-text">
                {{ errors[0] }}
              </span>
            </ValidationProvider>
          </div>
          <ValidationProvider
            v-slot="{ errors }"
            class="mt-4"
            name="fecha"
            rules="required"
            tag="div">
            <label for="fecha">
              Fecha *
            </label>
            <input
              id="fecha"
              v-model="payload.date"
              type="date"
              class="form-control"
              :class="{ 'has-errors': errors.length }"/>
            <span class="red-text">
              {{ errors[0] }}
            </span>
          </ValidationProvider>
          <ValidationProvider
            v-slot="{ errors }"
            class="mt-4"
            name="hora-pref"
            rules=""
            tag="div">
            <label>
              Hora preferencial
            </label>
            <VueTimepicker
              v-model="payload.preferred_hour"/>
            <span class="red-text">
              {{ errors[0] }}
            </span>
          </ValidationProvider>
          <ValidationProvider
            v-slot="{ errors }"
            class="mt-4"
            name="rango-horario"
            rules=""
            tag="div">
            <label>
              Rango horario
            </label>
            <VueTimepicker
              v-model="payload.range_hour_from"/>
            <VueTimepicker
              v-model="payload.range_hour_to"/>
            <span class="red-text">
              {{ errors[0] }}
            </span>
          </ValidationProvider>
        </div>
      </div>
      <div class="to col-6">
        <h2>Hasta</h2>
        <div class="block-form">
          <ValidationProvider
            v-slot="{ errors }"
            tag="div"
            name="provincia-hasta"
            class="validator-provider"
            rules="required">
            <label for="provincia-hasta">
              Provincia *
            </label>
            <div class="input-group">
              <input
                id="provincia-hasta"
                v-model="payload['province_destination']"
                type="text"
                class="form-control"
                :class="{ 'has-errors': errors.length }"
                placeholder="Seleccionar Provincia"/>
            </div>
            <span class="red-text">
              {{ errors[0] }}
            </span>
          </ValidationProvider>
          <ValidationProvider
            v-slot="{ errors }"
            tag="div"
            name="ciudad-hasta"
            class="validator-provider mt-4"
            rules="required">
            <label for="ciudad-hasta">
              Ciudad *
            </label>
            <div class="input-group">
              <input
                id="ciudad-hasta"
                v-model="payload['city_destination']"
                type="text"
                class="form-control"
                :class="{ 'has-errors': errors.length }"
                placeholder="Seleccionar Ciudad"/>
            </div>
            <span class="red-text">
              {{ errors[0] }}
            </span>
          </ValidationProvider>
          <ValidationProvider
            v-slot="{ errors }"
            class="mt-4"
            name="calle-hasta"
            rules="required"
            tag="div">
            <label for="calle-hasta">
              Calle *
            </label>
            <input
              id="calle-hasta"
              v-model="payload['street_destination']"
              type="text"
              class="form-control"
              :class="{ 'has-errors': errors.length }"/>
            <span class="red-text">
              {{ errors[0] }}
            </span>
          </ValidationProvider>
          <div class="row no-gutters address-info mt-4">
            <ValidationProvider
              v-slot="{ errors }"
              name="numero-hasta"
              rules="required">
              <label for="numero-hasta">
                Nro. *
              </label>
              <input
                id="numero-hasta"
                v-model="payload['street_number_destination']"
                type="text"
                class="form-control"
                :class="{ 'has-errors': errors.length }"/>
              <span class="red-text">
                {{ errors[0] }}
              </span>
            </ValidationProvider>
            <ValidationProvider
              v-slot="{ errors }"
              name="piso-hasta"
              rules="">
              <label for="piso-hasta">
                Piso
              </label>
              <input
                id="piso-hasta"
                v-model="payload['flat_number_destination']"
                type="text"
                class="form-control"
                :class="{ 'has-errors': errors.length }"/>
              <span class="red-text">
                {{ errors[0] }}
              </span>
            </ValidationProvider>
            <ValidationProvider
              v-slot="{ errors }"
              name="departamento-hasta"
              rules="">
              <label for="departamento-hasta">
                Dpto.
              </label>
              <input
                id="departamento-hasta"
                v-model="payload['flat_letter_destination']"
                type="text"
                class="form-control"
                :class="{ 'has-errors': errors.length }"/>
              <span class="red-text">
                {{ errors[0] }}
              </span>
            </ValidationProvider>
          </div>
        </div>
      </div>
    </div>
    <div>
      <h2 class="mt-5">
        Describa lo que desea transportar
      </h2>
      <div class="block-form">
        <ValidationProvider
          v-slot="{ errors }"
          tag="div"
          name="descripcion"
          class="validator-provider"
          rules="required">
          <div class="input-group">
            <textarea
              v-model="payload.description"
              class="form-control"
              :class="{ 'has-errors': errors.length }"></textarea>
          </div>
          <span class="red-text">
            {{ errors[0] }}
          </span>
        </ValidationProvider>
      </div>
      <h2 class="mt-5">
        Detalles adicionales
      </h2>
      <div class="block-form">
        <div class="form-group form-check">
          <input
            id="operarios"
            v-model="payload['need_more_carriers']"
            type="checkbox"
            class="form-check-input"/>
          <label
            class="form-check-label"
            for="operarios">Se precisan dos o más operarios</label>
        </div>

        <label for="ascensor-origen">
          ¿Hay ascensor en origen?
        </label>
        <div class="d-flex">
          <div
            id="ascensor-origen"
            class="custom-control custom-radio custom-control-inline">
            <input
              id="si-origen"
              v-model="payload['is_elevator_origin']"
              type="radio"
              name="ascensor-origen"
              class="custom-control-input"
              :value="true"/>
            <label
              class="custom-control-label"
              for="si-origen">Si</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input
              id="no-origen"
              v-model="payload['is_elevator_origin']"
              type="radio"
              name="ascensor-origen"
              class="custom-control-input"
              :value="false"/>
            <label
              class="custom-control-label"
              for="no-origen">No</label>
          </div>
        </div>
        <div class="ascensor-radio mt-4">
          <label for="ascensor-destination">
            ¿Hay ascensor en destino?
          </label>
          <div class="d-flex">
            <div
              id="ascensor-destino"
              class="custom-control custom-radio custom-control-inline">
              <input
                id="si-destino"
                v-model="payload['is_elevator_destination']"
                type="radio"
                name="ascensor-destino"
                class="custom-control-input"
                :value="true"/>
              <label
                class="custom-control-label"
                for="si-destino">Si</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input
                id="no-destino"
                v-model="payload['is_elevator_destination']"
                type="radio"
                name="ascensor-destino"
                class="custom-control-input"
                :value="false"/>
              <label
                class="custom-control-label"
                for="no-destino">No</label>
            </div>
          </div>
        </div>
        <ValidationProvider
          v-slot="{ errors }"
          tag="div"
          name="aclaraciones"
          class="validator-provider mt-4"
          rules="">
          <label for="aclaraciones">
            Instrucciones o aclaraciones importantes
          </label>
          <div class="input-group">
            <textarea
              id="aclaraciones"
              v-model="payload.clarifications"
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
        Solicitar
      </button>
      <button
        type="button"
        class="btn outline mx-3"
        @click="goBack()">
        Cancelar
      </button>
    </div>
  </ValidationObserver>
</template>

<script>
  import VueTimepicker from 'vue2-timepicker/src/vue-timepicker.vue';
  import { CLIENT_REQUESTS_ROUTE } from 'Constants/clients/routes';
  import helpers from 'Base/utils/helpers';

  export default {
    components: { VueTimepicker },

    data() {
      return {
        payload: {
          city_destination: '',
          city_origin: '',
          clarifications: '',
          date: '',
          description: '',
          flat_letter_destination: '',
          flat_letter_origin: '',
          flat_number_destination: '',
          flat_number_origin: '',
          is_elevator_origin: false,
          is_elevator_destination: false,
          need_more_carriers: '',
          preferred_hour: '',
          province_destination: '',
          province_origin: '',
          range_hour_from: '',
          range_hour_to: '',
          street_destination: '',
          street_origin: '',
          street_number_destination: '',
          street_number_origin: '',
          time: '',
        },
        saving: false,
      }
    },

    methods: {
      goBack() {
        this.$router.push({ name: CLIENT_REQUESTS_ROUTE });
      },

      onSubmit () {
        this.saving = true
        this.$store.dispatch('requests/create', this.payload)
          .then(() => {
            this.$toast.success('Solicitud creada correctamente');
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