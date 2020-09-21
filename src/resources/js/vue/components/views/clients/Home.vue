<template>
  <div class="client-home">
    <img class="background"
         src="/images/home-background.png"/>

    <div class="wrapper">
      <img class="img img-fluid client-img"
           src="/images/client.png"/>

      <div class="content mt-3">
        <p class="mb-3">
          <strong>¿Necesitás mudarte o enviar un mueble?</strong>
        </p>

        <p class="mb-3 text-center">
          Con MiFlete podrás contactarte con transportistas cerca tuyo, comparar ofertas y elegir la que mejor se adapte a tus necesidades.
        </p>

        <p class="mb-0">
          Comienza creando tu primera solicitud:
        </p>

        <button class="btn primary">
          Nueva Solicitud
        </button>
      </div>
    </div>
  </div>
</template>

<script>
  export default {

  }
</script>

<style lang="scss" scoped>
  @import 'Assets/_variables.scss';
  @import 'Assets/_mixins.scss';
  @import 'Assets/_buttons.scss';
  @import 'Assets/utils/_breakpoints';
  @import 'Assets/_background';

  .client-home {
    @include flex(row, center, center, wrap);
    height: 100%;

    .background {
      @include background();
    }

    .wrapper {
      @include flex(row, center, center, wrap);
      position: relative;
      z-index: 1;
      width: 90%;
      margin-top: 8rem;

      @include media-breakpoint-down(lg) {
        width: 100%;
      }

      .client-img {
        width: 8rem;

        @include media-breakpoint-down(sm) {
          display: none;
        }
      }

      .content {
        @include flex(column, center, center, wrap);
        width: 50%;

        @include media-breakpoint-down(lg) {
          width: 65%;
        }

        @include media-breakpoint-down(sm) {
          width: 100%;
        }

        p {
          font-size: 1.5rem;

          @include media-breakpoint-down(lg) {
            font-size: 1.3rem;
          }

          @include media-breakpoint-down(xs) {
            font-size: 1rem;
          }
        }
      }
    }
  }
</style>