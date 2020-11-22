<template>
  <div class="row no-gutters h-100 justify-content-center">
    <Loader v-if="loading"/>

    <div v-if="!loading && replies.length === 0">
      <p class="font-weight-bold">
        Aún no tienes ofertas para la solicitud actual
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
              :disabled="reply.status !== pending"
              type="button"
              @click="acceptReply(reply)">
              <font-awesome-icon
                class="navbar-icon"
                :icon="['far', 'check-circle']"
                size="1x"/>
              Aceptar
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
        'replies',
      ])
    },

    created () {
      this.fetchReplies();
    },

    methods: {
      fetchReplies () {
        this.loading = true;
        this.$store.dispatch('requests/fetchReplies', this.$route.params.id || null)
          .finally(() => this.loading = false);
      },

      acceptReply (reply) {
        this.$confirm('Estás a punto de aceptar esta oferta, ¿Deseas continuar?', 'Atención', 'warning', {
          confirmButtonText: 'Aceptar',
          cancelButtonText: 'Cancelar'
        })
          .then(() => {
            this.posting = true;
            const payload = {
              requestId: this.$route.params.id,
              replyId: reply.id
            }
            this.$store.dispatch('requests/acceptReply', payload)
              .then(() => {
                this.$toast.success('Oferta aceptada');
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