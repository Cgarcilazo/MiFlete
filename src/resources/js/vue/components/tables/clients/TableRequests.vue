<template>
  <div class="row no-gutters justify-content-center">
    <Loader v-if="loading"/>

    <div v-if="!loading && requests.length === 0">
      <p class="font-weight-bold">
        Aún no tienes solicitudes cargadas
      </p>
    </div>

    <table v-if="!loading && requests.length > 0"
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
          v-for="(request, index) in requests"
          :key="index">
          <td>{{ request['origin_full_address'] }}</td>
          <td>{{ request['destination_full_address'] }}</td>
          <td>{{ request.date }}</td>
          <td>{{ request['replies_count'] }}</td>
          <td>{{ request.status }}</td>
          <td>
            <button
              class="btn btn-link p-1"
              :disabled="request.status !== pending"
              type="button">
              <font-awesome-icon
                class="navbar-icon"
                icon="edit"
                size="1x"/>
              Editar
            </button>
            <button
              class="btn btn-link p-1"
              :disabled="request['replies_count'] === 0 || request.status == canceled"
              type="button"
              @click="goToReplies(request)">
              <font-awesome-icon
                class="navbar-icon"
                :icon="['fas', 'external-link-alt']"
                size="1x"/>
              Ver ofertas
            </button>
            <button
              class="btn btn-link p-1"
              :class="{ 'btn-delete' : request.status == pending }"
              :disabled="!(request.status == pending)"
              type="button"
              @click="cancelRequest(request)">
              <font-awesome-icon
                class="navbar-icon"
                :icon="['fas', 'times-circle']"
                size="1x"/>
              Cancelar
            </button>
            <button
              class="btn btn-link p-1"
              :class="{ 'btn-delete' : request.status === done || request.status === canceled }"
              :disabled="request.status !== done && request.status !== canceled"
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
  import { mapState } from 'vuex';
  import Loader from 'Components/resources/Loader';
  import helpers from 'Base/utils/helpers';
  import { CLIENT_REPLIES } from 'Constants/clients/routes';

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
        posting: false,
      }
    },

    computed: {
      ...mapState('requests', [
        'requests',
      ])
    },

    created () {
      this.fetchRequests();
    },

    methods: {
      fetchRequests () {
        this.loading = true;
        this.$store.dispatch('requests/fetchAllByClient')
          .finally(() => this.loading = false);
      },

      cancelRequest (request) {
        this.$confirm('Estás a punto de cancelar la solicitud, ¿Deseas continuar?', 'Atención', 'warning', {
          confirmButtonText: 'Aceptar',
          cancelButtonText: 'Cancelar'
        })
          .then(() => {
            this.posting = true;
            this.$store.dispatch('requests/cancel', request)
              .then(() => {
                this.$toast.success('Solicitud cancelada correctamente');
                this.fetchRequests();
              })
              .catch((error) => {
                if (error.response.data.data.errors != null) {
                  let errorList = helpers.handleResponseErrors(error.response.data.data.errors);
                  this.$toast.error(errorList[0]);
                } else {
                  this.$toast.error(error.response.data.error);
                }
              })
              .finally(() => this.posting = false);
          })
      },

      goToReplies (request) {
        this.$router.push({ name: CLIENT_REPLIES, params: { id: request.id } });
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