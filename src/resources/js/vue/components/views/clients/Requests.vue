<template>
  <div class="requests-view">
    <div class="requests-header">
      <img
        class="background"
        src="/images/client-home-background.jpg"/>
      <h2 class="page-title">
        {{ showForm ? 'Registrar solicitud' : 'Administrar solicitudes' }}
      </h2>
    </div>
    <div
      v-if="!showForm"
      class="requests-body container h-100 p-0">
      <button
        class="btn secondary"
        @click="newRequest">
        <font-awesome-icon
          icon="plus"
          size="1x"/>
        Nueva Solicitud
      </button>
      <TableRequests/>
    </div>
    <div
      v-else
      class="requests-body container h-100 p-0">
      <NewRequestForm/>
    </div>
  </div>
</template>

<script>
  import TableRequests from 'Components/tables/TableRequests'
  import NewRequestForm from 'Components/forms/NewRequestForm'
  export default {
    components: { TableRequests, NewRequestForm },

    data() {
      return {
        showForm: false
      }
    },

    methods: {
      newRequest() {
        this.showForm = true
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