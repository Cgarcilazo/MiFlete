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
              class="landing-icons"
              icon="search-dollar"
              size="5x"/>
            <h2>LOS <mark>CLIENTES</mark> ENCUENTRAN EL MEJOR PRECIO</h2>
          </div>
          <div class="paragraph-icon-wrapper">
            <h2>LOS <mark>TRANSPORTISTAS</mark> LLEGAN A MÁS CLIENTES</h2>
            <font-awesome-icon
              class="landing-icons"
              icon="users"
              size="5x"/>
          </div>
        </div>
      </div>
      <div class="how-works-wrapper">
        <h1>¿Cómo funciona miFlete?</h1>
        <Tip title="Publicá"/>
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

.content-background {
  background-image: url("/images/landing-img.jpg");
  width: 100%;
  height: 55rem;

.paragraph-container {
  width: 45%;
  padding: 6rem;
}
.paragraphs-wrapper {
  @include flex(column, center, space-between, wrap);
  .paragraph-icon-wrapper {
    @include flex(row, center, space-between, wrap);
    width: 35%;
    margin: 3rem 0;

    h2 {
      font-weight: $bold;
      width: 85%;
      margin: 0;

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
  }
}

</style>
