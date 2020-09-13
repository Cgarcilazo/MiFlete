<template>
  <div>
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