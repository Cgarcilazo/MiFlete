<template>
  <div class="tip-wrapper">
    <div class="number-arrow-wrapper">
      <h1 class="number"
          :class="`${color}-bg`">
        {{ number }}
      </h1>
      <font-awesome-icon
        v-if="arrow"
        class="arrow"
        :class="`${color}-font`"
        icon="angle-right"
        size="5x"/>
    </div>
    <h1
      class="title"
      :class="`${color}-font`">
      {{ title }}
    </h1>
    <h4 class="text">
      <slot></slot>
    </h4>
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
        required: true
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
  @import 'Assets/utils/_breakpoints';

  .tip-wrapper {
    @include flex(column, flex-start, space-between, wrap);
    width: 30%;

    .number-arrow-wrapper {
      @include flex(row, center, space-between, wrap);
      width: 100%;

      .number {
        font-size: 5rem;
        width: max-content;
        padding: 1rem 2.5rem;
        border-radius: 50%;
        color: $white;
        font-weight: $bold;

        @include media-breakpoint-down(xl) {
          font-size: 4rem;
          padding: 1rem 2rem;
        }

        @include media-breakpoint-down(md) {
          font-size: 3rem;
          padding: 1rem 1.75rem;
        }

        @include media-breakpoint-down(sm) {
          font-size: 1.5rem;
          padding: .75rem 1rem;
        }
      }

      .arrow {
        @include media-breakpoint-down(sm) {
          font-size: 2rem;
        }
      }
    }

    .title {
      font-weight: $bold;

      @include media-breakpoint-down(md) {
        font-size: 1.75rem;
      }

      @include media-breakpoint-down(sm) {
        font-size: 1rem;
      }
    }

    .text {
      font-weight: bold;
      font-size: 1.5rem;

      @include media-breakpoint-down(md) {
        font-size: 1rem;
      }

      @include media-breakpoint-down(sm) {
        font-size: .8rem;
        font-weight: normal;
      }
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