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