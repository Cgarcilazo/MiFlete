<template>
  <div class="requests-view">
    <div class="requests-header">
      <img
        class="background"
        src="/images/client-home-background.jpg"/>
      <h2 class="page-title">
        Detalles de la solicitud
      </h2>
    </div>
    <div class="requests-body container h-100 p-0">
      <Loader
        v-if="loading"
        class="text-center"/>
      <div v-else>
        <RequestDetails
          :request="request"/>
        <div class="d-flex my-3 justify-content-center">
          <button
            type="button"
            class="btn outline mx-3"
            @click="goBack()">
            Volver
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { CLIENT_REQUESTS_ROUTE } from 'Constants/clients/routes';
  import RequestDetails from 'Components/forms/clients/RequestDetails';
  import Loader from 'Components/resources/Loader';
  import helpers from 'Base/utils/helpers';
  import { mapState } from 'vuex';

  export default {
    components: {
      RequestDetails,
      Loader,
    },

    data() {
      return {
        loading: false,
      }
    },

    computed: {
      ...mapState('requests', [
        'request',
      ]),
    },

    created () {
      this.loading = true;
      this.$store.dispatch('requests/fetchById', this.$route.params.id)
        .catch((error) => {
          if (error.response.data.data.errors != null) {
            let errorList = helpers.handleResponseErrors(error.response.data.data.errors);
            this.$toast.error(errorList[0]);
          } else {
            this.$toast.error(error.response.data.error);
          }
        })
        .finally(() => this.loading = false);
    },

    methods: {
      goBack() {
        this.$router.push({ name: CLIENT_REQUESTS_ROUTE });
      },
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