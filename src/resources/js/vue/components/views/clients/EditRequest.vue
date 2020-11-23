<template>
  <div class="requests-view">
    <div class="requests-header">
      <img
        class="background"
        src="/images/client-home-background.jpg"/>
      <h2 class="page-title">
        Editar la solicitud
      </h2>
    </div>
    <div class="requests-body container h-100 p-0">
      <NewRequestForm/>
    </div>
  </div>
</template>

<script>
  import NewRequestForm from 'Components/forms/clients/NewRequestForm'
  export default {
    components: { NewRequestForm }

  }
</script>