<template>
  <div>
    <div class="row">
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
  </div>
</template>

<script>
  export default {
    props: {
      request: {
        type: Object,
        required: true,
      }
    }
  }
</script>