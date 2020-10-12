<template>
  <div class="h-100">
    <Navbar/>
    <router-view class="page-container"/>
  </div>
</template>

<script>
  import Navbar from 'Components/Navbar'
  export default {
    components: { Navbar }

  }
</script>

<style lang="scss">
@import 'Assets/utils/_breakpoints.scss';

.page-container {
  @include media-breakpoint-down(xxl) {
    padding-top: 6.9rem;
  }

  @include media-breakpoint-down(lg) {
    padding-top: 8.2rem;
  }

  @include media-breakpoint-down(md) {
    padding-top: 5rem;
  }
}
</style>