<template>
  <div class="row no-gutters h-100 justify-content-center">
    <Loader v-if="loading"/>

    <div v-if="!loading && replies.length === 0">
      <p class="font-weight-bold">
        Aún no hay ofertas realizadas
      </p>
    </div>

    <table v-if="!loading && replies.length > 0"
           class="table table-striped table-bordered table-hover">
      <thead class="table-header">
        <tr>
          <th>Precio</th>
          <th>Descripción</th>
          <th>Estado</th>
          <th class="w-25">
            Acciones
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="(reply, index) in replies"
          :key="index">
          <td>{{ reply['price'] }}</td>
          <td>{{ reply['description'] || '-' }}</td>
          <td>{{ reply.status }}</td>
          <td>
            <button
              class="btn btn-link p-1"
              :class="{ 'btn-delete' : reply.status == pending }"
              :disabled="!(reply.status == pending)"
              type="button"
              @click="cancelReply(reply)">
              <font-awesome-icon
                class="navbar-icon"
                :icon="['fas', 'times-circle']"
                size="1x"/>
              Cancelar
            </button>
            <button
              class="btn btn-link p-1"
              :class="{ 'btn-delete' : reply.status === done || reply.status === rejected }"
              :disabled="reply.status !== done && reply.status !== rejected"
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
  import { REJECTED } from 'Constants/general/replies';
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
        rejected: REJECTED,
        fields: ['Origen', 'Destino', 'Fecha', 'Ofertas Recibidas', 'Estado'],
        loading: false,
        posting: false,
      }
    },

    computed: {
      ...mapState('replies', [
        'replies',
      ])
    },

    created () {
      this.fetchReplies();
    },

    methods: {
      fetchReplies () {
        this.loading = true;
        this.$store.dispatch('replies/fetchAllByCarrier')
          .finally(() => this.loading = false);
      },

      cancelReply (reply) {
        this.$confirm('Estás a punto de cancelar la oferta, ¿Deseas continuar?', 'Atención', 'warning', {
          confirmButtonText: 'Aceptar',
          cancelButtonText: 'Cancelar'
        })
          .then(() => {
            this.posting = true;
            this.$store.dispatch('replies/cancel', reply)
              .then(() => {
                this.$toast.success('Oferta cancelada correctamente');
                this.fetchReplies();
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