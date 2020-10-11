<template>
  <div class="row no-gutters h-100 justify-content-center align-items-center">
    <table class="table table-striped table-bordered table-hover">
      <thead class="table-header">
        <tr>
          <th>Origen</th>
          <th>Destino</th>
          <th>Fecha</th>
          <th>N° Ofertas</th>
          <th>Estado</th>
          <th class="w-25">
            Acciones
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="(request, index) in requests"
          :key="index">
          <td>{{ request.origin }}</td>
          <td>{{ request.destination }}</td>
          <td>{{ request.date }}</td>
          <td>{{ request.offers }}</td>
          <td>{{ request.state }}</td>
          <td>
            <button
              class="btn btn-link"
              :disabled="request.state !== pending"
              type="button">
              <font-awesome-icon
                class="navbar-icon"
                icon="edit"
                size="1x"/>
              Editar
            </button>
            <button
              class="btn btn-link"
              :class="{ 'btn-delete' : request.state === done || request.state === canceled }"
              :disabled="request.state !== done && request.state !== canceled"
              type="button">
              <font-awesome-icon
                class="navbar-icon"
                :icon="['far', 'trash-alt']"
                size="1x"/>
              Eliminar
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
  import { CANCELED, DONE, PENDING, RESERVED } from 'Constants/general/requests'
  export default {
    data() {
      return {
        canceled: CANCELED,
        done: DONE,
        pending: PENDING,
        reserved: RESERVED,
        fields: ['Origen', 'Destino', 'Fecha', 'Ofertas Recibidas', 'Estado'],
        requests: [
          { origin: 'Resistencia-25 de Mayo 1235', destination: 'Resistencia- 9 de Julio 315', date: '12-10-2020', offers: 3, state: 'Reservado'},
          { origin: 'Resistencia-25 de Mayo 1235', destination: 'Resistencia- 9 de Julio 315', date: '12-10-2020', offers: 4, state: 'Realizado'},
          { origin: 'Resistencia-25 de Mayo 1235', destination: 'Resistencia- 9 de Julio 315', date: '12-10-2020', offers: 5, state: 'Cancelado'},
          { origin: 'Resistencia-25 de Mayo 1235', destination: 'Resistencia- 9 de Julio 315', date: '12-10-2020', offers: 6, state: 'Pendiente'}
        ],
      }
    },

  }
</script>

<style lang="scss">
  @import 'Assets/_variables.scss';

  .table-header {
    background-color: $green;

    th {
      text-align: center;
      vertical-align: middle !important;
    }
  }

  td {
    vertical-align: middle !important;
  }
</style>