<template>
  <div class="requests-view">
    <div class="requests-header">
      <img
        class="background"
        src="/images/client-home-background.jpg"/>
      <h2 class="page-title">
        Ofertas para la solicitud actual
      </h2>
    </div>
    <div class="replies-body container p-0">
      <TableReplies/>
    </div>
  </div>
</template>

<script>
  import TableReplies from 'Components/tables/clients/TableReplies'
  export default {
    components: { TableReplies },

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

    .replies-body {
      margin-top: 3rem;
      height: 100vh;
    }
  }

</style>