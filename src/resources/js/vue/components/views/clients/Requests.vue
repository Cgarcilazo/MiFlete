<template>
  <div class="requests-view">
    <div class="requests-header">
      <img
        class="background"
        src="/images/client-home-background.jpg"/>
      <h2 class="page-title">
        Administrar solicitudes
      </h2>
    </div>
    <div class="requests-body container h-100 p-0">
      <button
        class="btn secondary"
        @click="goToNewRequest()">
        <font-awesome-icon
          icon="plus"
          size="1x"/>
        Nueva Solicitud
      </button>
      <TableRequests/>
    </div>
  </div>
</template>

<script>
  import TableRequests from 'Components/tables/TableRequests'
  import NewRequestForm from 'Components/forms/NewRequestForm'
  import { CLIENT_NEW_REQUEST_ROUTE } from 'Constants/clients/routes';
  export default {
    components: { TableRequests },

    data() {
      return {

      }
    },

    methods: {
      goToNewRequest() {
        this.$router.push( { name: CLIENT_NEW_REQUEST_ROUTE } )
      }
    }
  }
</script>

<style lang="scss">
  @import 'Assets/_variables.scss';
  @import 'Assets/mixins/_flex.scss';
  @import 'Assets/mixins/_background.scss';

  .requests-view {
    background-color: $background-grey;
    .requests-header {
      @include flex(column, center, center, wrap);
      height: 8rem;

      .background {
        @include background(absolute);
        height: 8rem;
      }

      .page-title {
        z-index: 1;
        position: absolute;
        font-weight: $bold;
      }
    }

    .requests-body {
      margin-top: 3rem;
    }
  }

</style>