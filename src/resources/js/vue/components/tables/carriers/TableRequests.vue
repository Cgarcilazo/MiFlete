<template>
  <div class="row no-gutters h-100 justify-content-center align-items-center">
    <Loader v-if="loading"/>

    <div v-if="!loading && pendingRequests.length === 0">
      <p class="font-weight-bold">
        Aún no existen solicitudes cargadas
      </p>
    </div>

    <table v-if="!loading && pendingRequests.length > 0"
           class="table table-striped table-bordered table-hover">
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
          v-for="(request, index) in pendingRequests"
          :key="index">
          <td>{{ request['origin_full_address'] }}</td>
          <td>{{ request['destination_full_address'] }}</td>
          <td>{{ request.date }}</td>
          <td>{{ request['replies_count'] }}</td>
          <td>{{ request.status }}</td>
          <td>
            <button
              class="btn btn-link"
              :disabled="request.status !== pending"
              type="button">
              <font-awesome-icon
                class="navbar-icon"
                :icon="['fas', 'external-link-alt']"
                size="1x"/>
              Ofertar
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
  import { CANCELED, DONE, PENDING, RESERVED } from 'Constants/general/requests'
  import { mapState } from 'vuex';
  import Loader from 'Components/resources/Loader';

  export default {
    components: {
      Loader,
    },

    data() {
      return {
        canceled: CANCELED,
        done: DONE,
        pending: PENDING,
        reserved: RESERVED,
        fields: ['Origen', 'Destino', 'Fecha', 'Ofertas Recibidas', 'Estado'],
        loading: false,
      }
    },

    computed: {
      ...mapState('requests', [
        'pendingRequests',
      ])
    },

    created () {
      this.loading = true;
      this.$store.dispatch('requests/fetchAllPending')
        .finally(() => this.loading = false);
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