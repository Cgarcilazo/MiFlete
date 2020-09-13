<template>
  <div class="client-home">
    <img class="background"
         src="/images/client-home-background.jpg"/>

    <div class="wrapper">
      <img class="img img-fluid client-img"
           src="/images/client.png"/>

      <div class="content mt-3">
        <p class="mb-3">
          ¿Necesitás mudarte o enviar un mueble?
        </p>

        <p class="mb-3 text-center">
          Con MiFlete podrás contactarte con transportistas cerca tuyo, comparar ofertas y elegir la que mejor se adapte a tus necesidades.
        </p>

        <p class="mb-0">
          Comienza creando tu primera solicitud:
        </p>

        <button class="btn primary">
          Nueva Solitud
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
      @include flex(row, flex-start, flex-start, wrap);
      position: relative;
      z-index: 1;
      width: 50%;

      .client-img {
        width: 8rem;
        margin-left: 6.6rem;
      }

      .content {
        @include flex(column, center, center, wrap);
        width: 50%;
      }
    }
  }
</style>