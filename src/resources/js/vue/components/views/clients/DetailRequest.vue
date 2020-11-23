<template>
  <div class="requests-view">
    <div class="requests-header">
      <img
        class="background"
        src="/images/client-home-background.jpg"/>
      <h2 class="page-title">
        Detalle de solicitud
      </h2>
    </div>
    <div class="requests-body container h-100 p-0">
      <DetailRequestForm/>
    </div>
  </div>
</template>

<script>
  import DetailRequestForm from 'Components/forms/DetailRequestForm'
  export default {
    components: { DetailRequestForm }

  }
</script>