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
      <button class="btn secondary">
        <font-awesome-icon
          icon="plus"
          size="1x"/>
        Nueva Solicitud
      </button>
      <TableRequests
        :fields="fields"/>
    </div>
  </div>
</template>

<script>
  import TableRequests from 'Components/tables/TableRequests'
  export default {
    components: { TableRequests },

    data() {
      return {
        fields: ['Origen', 'Destino', 'Fecha', 'Ofertas Recibidas', 'Estado']
      }
    }
  }
</script>

<style lang="scss">
  @import 'Assets/_variables.scss';
  @import 'Assets/_mixins.scss';

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