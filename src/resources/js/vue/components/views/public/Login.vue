<template>
  <div class="login-view">
    <img
      class="background"
      src="/images/register-background.png"/>
    <div class="login-block">
      <img
        class="logo"
        src="/images/logotext.png"/>
      <div class="login-form">
        <div class="input-group mb-3">
          <input
            type="email"
            class="form-control"
            placeholder="Email"/>
          <div class="input-group-append">
            <font-awesome-icon :icon="['far', 'envelope']"/>
          </div>
        </div>
        <div class="input-group mb-3">
          <input
            type="password"
            class="form-control"
            placeholder="Contraseña"/>
          <div class="input-group-append">
            <font-awesome-icon :icon="['fas', 'key']"/>
          </div>
        </div>
        <button class="btn primary">
          Login
        </button>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {

      }
    }
  }
</script>

<style lang="scss">
@import 'Assets/_variables.scss';
@import 'Assets/_mixins.scss';
@import 'Assets/_buttons.scss';

.login-view {
  @include flex(column, center, center, wrap);
  color: $green;
  height: 100vh;

  .background {
    position: fixed;
    z-index: 0;
    opacity: .5;
    width: 100%;
  }

  .login-block {
    @include flex(column, center, space-between, wrap);
    background-color: $white;
    padding: 20px;
    width: 25%;
    border-radius: $radius;
    position: relative;
    z-index: 10;

    .logo {
      width: 10rem;
      margin: 2rem;
    }

    .login-form {
      @include flex(column, center, space-between, wrap);
      width: 60%;
      margin: 2rem 0;

      .input-group {
        border: 1px solid $light-grey;
        border-radius: $radius;
        margin-bottom: 2rem !important;

        .form-control {
          border: none;

          &:focus {
            box-shadow: none;
          }
        }

        .input-group-append {
          background-color: $light-blue ;
          border-radius: 0 $radius $radius 0;
          color: $grey;
          opacity: .3;
          padding: 10px;
        }
        }
    }
  }
}
</style>