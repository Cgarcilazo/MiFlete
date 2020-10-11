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
              :disabled="request.state !== 'pendiente'"
              type="button">
              <font-awesome-icon
                class="navbar-icon"
                icon="edit"
                size="1x"/>
              Editar
            </button>
            <button
              class="btn btn-link"
              :class="{ 'btn-delete' : request.state === 'realizado' || request.state === 'cancelado' }"
              :disabled="request.state !== 'realizado' && request.state !== 'cancelado'"
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
  export default {
    props: {
      fields: {
        type: Array,
        required: true
      }
    },
    data() {
      return {
        requests: [
          { origin: 'Resistencia-25 de Mayo 1235', destination: 'Resistencia- 9 de Julio 315', date: '12-10-2020', offers: 3, state: 'reservado'},
          { origin: 'Resistencia-25 de Mayo 1235', destination: 'Resistencia- 9 de Julio 315', date: '12-10-2020', offers: 4, state: 'realizado'},
          { origin: 'Resistencia-25 de Mayo 1235', destination: 'Resistencia- 9 de Julio 315', date: '12-10-2020', offers: 5, state: 'cancelado'},
          { origin: 'Resistencia-25 de Mayo 1235', destination: 'Resistencia- 9 de Julio 315', date: '12-10-2020', offers: 6, state: 'pendiente'}
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