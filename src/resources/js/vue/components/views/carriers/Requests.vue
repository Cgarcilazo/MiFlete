<template>
  <div class="requests-view">
    <div class="requests-header">
      <img
        class="background"
        src="/images/client-home-background.jpg"/>
      <h2 class="page-title">
        Todas las solicitudes
      </h2>
    </div>
    <div class="requests-body container h-100 p-0">
      <TableRequests/>
    </div>
  </div>
</template>

<script>
  import TableRequests from 'Components/tables/carriers/TableRequests'
  import { CLIENT_NEW_REQUEST_ROUTE } from 'Constants/clients/routes';
  export default {
    components: { TableRequests },

    data() {
      return {

      }
    },
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