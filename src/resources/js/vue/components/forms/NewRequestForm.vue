<template>
  <ValidationObserver
    v-slot="{ }"
    slim>
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
                type="email"
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
            class="validator-provider"
            rules="required">
            <label for="ciudad-desde">
              Ciudad *
            </label>
            <div class="input-group">
              <input
                id="ciudad-desde"
                v-model="payload['city_origin']"
                type="email"
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
            name="calle-desde"
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
          <div class="row no-gutters address-info">
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
            <ValidationProvider v-slot="{ errors }"
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
            name="fecha"
            rules="required">
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
          <div class="form-check">
            <input
              id="hora-desde"
              class="form-check-input"
              type="radio"
              name="opciones-hora"
              value="option1"/>
            <label
              class="form-check-label"
              for="hora-desde">
              Hora
            </label>
            <VueTimepicker></VueTimepicker>
          </div>
          <div class="form-check">
            <input
              id="rango-desde"
              class="form-check-input"
              type="radio"
              name="opciones-hora"
              value="option2"/>
            <label
              class="form-check-label"
              for="rango-desde">
              Rango horario
            </label>
            <VueTimepicker></VueTimepicker>
            <VueTimepicker></VueTimepicker>
          </div>
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
                type="email"
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
            class="validator-provider"
            rules="required">
            <label for="ciudad-hasta">
              Ciudad *
            </label>
            <div class="input-group">
              <input
                id="ciudad-hasta"
                v-model="payload['city_destination']"
                type="email"
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
            name="calle-hasta"
            rules="required">
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
          <div class="row no-gutters address-info">
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
  </ValidationObserver>
</template>

<script>
  import VueTimepicker from 'vue2-timepicker/src/vue-timepicker.vue'

  export default {
    components: { VueTimepicker },

    data() {
      return {
        payload: {
          city_destination: '',
          city_origin: '',
          date: '',
          description: '',
          flat_letter_destination: '',
          flat_letter_origin: '',
          flat_number_destination: '',
          flat_number_origin: '',
          need_more_carriers: '',
          preferred_hour: '',
          province_destination: '',
          province_origin: '',
          range_hour_from: '',
          rante_hour_to: '',
          street_destination: '',
          street_origin: '',
          street_number_destination: '',
          street_number_origin: '',
        }
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
  height: 100%;

  .address-info {
    flex-direction: row;
    justify-content: space-between;

    .input-group {
      width: 30%;
    }

    span {
    //   input {
        width: 30%;
    //   }
    }
  }
}
</style>