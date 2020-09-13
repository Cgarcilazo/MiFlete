<template>
  <div class="tip-wrapper">
    <div class="number-arrow-wrapper">
      <h1 class="number"
          :class="`${color}-bg`">
        {{ number }}
      </h1>
      <font-awesome-icon
        v-if="arrow"
        :class="`${color}-font`"
        icon="angle-right"
        size="5x"/>
    </div>
    <h1
      class="title"
      :class="`${color}-font`">
      {{ title }}
    </h1>
    <template></template>
  </div>
</template>

<script>
  export default {
    props: {
      color: {
        type: String,
        default: 'green'
      },
      arrow: {
        type: Boolean,
        default: true
      },
      number: {
        type: String,
        default: '1'
      },
      title: {
        type: String,
        required: true
      }
    }
  }
</script>

<style lang="scss" scoped>
@import 'Assets/_variables.scss';
@import 'Assets/_mixins.scss';

.tip-wrapper {
  @include flex(column, flex-start, space-between, wrap);
  width: 15%;

  .number-arrow-wrapper {
    @include flex(row, center, space-between, wrap);
    width: 100%;

    .number {
      font-size: 5rem;
      width: max-content;
      padding: 1rem 2.5rem;
      border-radius: 50%;
      color: $white;
      font-weight: $bold
    }
  }

  .title {
    font-weight: $bold;
  }
}

.green-bg {
  background-color: $green;
}

.light-blue-bg {
  background-color: $light-blue;
}

.green-font {
  color: $green;
}

.light-blue-font {
  color: $light-blue;
}
</style>