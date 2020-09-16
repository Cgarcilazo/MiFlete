<template>
  <div class="d-flex mt-5 justify-content-center w-100">
    <Navbar/>
    <div class="mt-5 w-100">
      <div class="content-background">
        <h1 class="landing-paragraph paragraph-container">
          Simplificamos al máximo los envíos ayudando a los clientes
          a conectarse directamente con transportistas
        </h1>
        <div class="landing-paragraph paragraphs-wrapper">
          <div class="paragraph-icon-wrapper">
            <font-awesome-icon
              class="landing-icon"
              icon="search-dollar"
              size="5x"/>
            <h2>LOS <mark>CLIENTES</mark> ENCUENTRAN EL MEJOR PRECIO</h2>
          </div>
          <div class="paragraph-icon-wrapper">
            <h2>LOS <mark>TRANSPORTISTAS</mark> LLEGAN A MÁS CLIENTES</h2>
            <font-awesome-icon
              class="landing-icon"
              icon="users"
              size="5x"/>
          </div>
        </div>
      </div>
      <div class="how-works-wrapper">
        <h1 class="how-works-title">
          ¿Cómo funciona miFlete?
        </h1>
        <div class="user-tips">
          <img
            class="how-works-img"
            src="/images/client.png"
            height="400"/>
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
            height="400"/>
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

    data () {
      return {

      }
    }
  }
</script>

<style lang="scss">
  @import 'Assets/_variables.scss';
  @import 'Assets/_mixins.scss';
  @import 'Assets/utils/_breakpoints';

  .content-background {
    background-image: url("/images/landing-img.jpg");
    width: 100%;
    height: 55rem;

    @include media-breakpoint-down(md) {
      height: 35rem;
    }

    .paragraph-container {
      width: 60%;
      padding: 5rem;

      @include media-breakpoint-down(lg) {
        width: 80%;
        padding: 4rem;
      }

      @include media-breakpoint-down(md) {
        width: 100%;
        padding: 4rem 2rem 2rem 2rem;
      }
    }

    .paragraphs-wrapper {
      @include flex(column, center, space-between, wrap);

      .paragraph-icon-wrapper {
        @include flex(row, center, space-between, wrap);
        width: 40%;
        margin: 3rem 0;

        @include media-breakpoint-down(lg) {
          width: 50%;
        }

        @include media-breakpoint-down(md) {
          width: 80%;
          margin: 2rem 0;
        }

        .landing-icon {
          @include media-breakpoint-down(lg) {
            font-size: 4rem;
          }

          @include media-breakpoint-down(sm) {
            font-size: 3rem;
          }
        }

        h2 {
          font-weight: $bold;
          width: 80%;
          margin: 0;
          line-height: 3rem;

          @include media-breakpoint-down(lg) {
            font-size: 2rem;
          }

          @include media-breakpoint-down(md) {
            font-size: 1.5rem;
          }

          @include media-breakpoint-down(sm) {
            font-size: 1rem;
            line-height: 2rem;
          }

          mark {
            color: $grey;
            font-weight: $bold;
            background-color: $green;
          }
        }
      }
    }

    .landing-paragraph {
      color: $grey;
      font-weight: $bold;

      @include media-breakpoint-down(lg) {
        font-size: 2rem;
      }

      @include media-breakpoint-down(md) {
        font-size: 1.5rem;
      }
    }
  }

  .how-works-wrapper {
    @include flex(column, center, space-between, wrap);

    .how-works-title {
      margin-top: 3rem;
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
        width: 80%;
      }

      @include media-breakpoint-down(lg) {
        width: 90%;
      }

      .how-works-img {
        @include media-breakpoint-down(sm) {
          height: 10rem;
        }
      }

      .tips-container {
        @include flex(row, flex-start, space-between, wrap);
        width: 80%;
      }
    }
  }

</style>
