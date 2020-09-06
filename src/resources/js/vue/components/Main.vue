<template>
  <div id="app"
       class="h-100">
    <transition name="slide">
      <router-view/>
    </transition>
  </div>
</template>

<script>
  export default {
    name: 'App',
  }

</script>

<style lang="scss">
  @import 'Assets/_app.scss';
  @import 'Assets/_variables.scss';
  @import 'Assets/_mixins.scss';
  @import 'Assets/_buttons.scss';

  html, body {
    height: 100%;
  }
</style>
