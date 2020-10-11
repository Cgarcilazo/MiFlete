<template>
  <div class="justify-content-center w-100">
    <Navbar/>
    <div class="landing-content">
      <div class="how-works-wrapper">
        <h1 class="how-works-title">
          ¿Cómo funciona miFlete?
        </h1>
        <div class="user-tips">
          <img
            class="how-works-img"
            src="/images/client.png"
            height="300"/>
          <div class="tips-container">
            <Tip
              title="Publica"
              number="1"
              color="light-blue">
              Publica lo que necesitas transportar
            </Tip>
            <Tip
              title="Compara"
              number="2"
              color="light-blue">
              Compara entre varios presupuestos
            </Tip>
            <Tip
              title="Envia"
              number="3"
              color="light-blue">
              Elige el que quieras y envíalo!
            </Tip>
          </div>
        </div>
        <div class="user-tips">
          <img
            class="how-works-img"
            src="/images/carrier.png"
            height="300"/>
          <div class="tips-container">
            <Tip
              title="Busca"
              number="1">
              Busca entre las solicitudes de transporte
            </Tip>
            <Tip
              title="Oferta"
              number="2">
              Publica el precio que solicitas por prestar tus servicios de transporte
            </Tip>
            <Tip
              title="Transporta"
              number="3">
              Si tu oferta es la elegida, transportalo!
            </Tip>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import Navbar from 'Components/Navbar'
  import Tip from 'Components/Tip'

  export default {
    components: { Navbar, Tip },
  }
</script>

<style lang="scss">
  @import 'Assets/_variables.scss';
  @import 'Assets/_mixins.scss';
  @import 'Assets/utils/_breakpoints';

  .landing-content {
    background-color: $background-grey;
    padding-top: 5rem;
    width: 100%;
    height: 100%;

    .how-works-wrapper {
      @include flex(column, center, space-between, wrap);

      .how-works-title {
        margin-top: 2.5rem;
        font-weight: $bold;

        @include media-breakpoint-down(sm) {
          font-size: 1.5rem;
        }
      }

      .user-tips {
        @include flex(row, center, space-between, wrap);
        width: 70%;
        margin: 1rem 0;

        @include media-breakpoint-down(xl) {
          width: 85%;
        }

        @include media-breakpoint-down(lg) {
          width: 90%;
        }

        .how-works-img {
          @include media-breakpoint-down(xl) {
            height: 250px;
          }

          @include media-breakpoint-down(sm) {
            display: none;
          }
        }

        .tips-container {
          @include flex(row, flex-start, space-between, wrap);
          width: 85%;

          @include media-breakpoint-down(sm) {
            width: 100%;
          }
        }
      }
    }
  }

</style>
