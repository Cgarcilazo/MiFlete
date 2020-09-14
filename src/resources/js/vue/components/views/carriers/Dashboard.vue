<template>
  <div class="h-100">
    <Navbar/>
    <router-view/>
  </div>
</template>

<script>
  import Navbar from 'Components/Navbar'
  export default {
    components: { Navbar }

  }
</script>