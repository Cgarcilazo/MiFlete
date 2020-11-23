<template>
  <div class="requests-view">
    <div class="requests-header">
      <img
        class="background"
        src="/images/client-home-background.jpg"/>
      <h2 class="page-title">
        Crear Oferta
      </h2>
    </div>
    <div class="requests-body container h-100 p-0">
      <NewReplyForm/>
    </div>
  </div>
</template>

<script>
  import NewReplyForm from 'Components/forms/carriers/NewReplyForm'
  export default {
    components: { NewReplyForm }

  }
</script>