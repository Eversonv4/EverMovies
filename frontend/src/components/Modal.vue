<script setup lang="ts">
import { ref, watch } from "vue";

const props = defineProps<{
  active: boolean;
  id: string;
}>();

const activeState = ref(props.active);

watch(
  () => props.active,
  (val) => {
    activeState.value = val;
  }
);
</script>

<template>
  <div :id="props.id" :class="['modal', { active: activeState }]">
    <slot></slot>
  </div>
</template>

<style lang="scss" scoped>
@use "../scss/" as *;

.modal {
  @include flex(center, center);
  position: fixed;
  z-index: 100;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  overflow: auto;
  background-color: rgba($color: $black, $alpha: 0.4);
  opacity: 0;
  visibility: hidden;

  &.active {
    opacity: 1;
    visibility: visible;
  }

  &__content {
    padding: 2rem;
    background-color: $body-bg;
    width: 50%;
    opacity: 0;
    transform: translateY(-250px);
    transition: transform 0.6s ease, opacity 0.6s ease;
    position: relative;

    @include tablet {
      width: 80%;
    }

    &__close {
      position: absolute;
      right: 5px;
      top: 5px;
      font-size: 1.5rem;
      cursor: pointer;

      &:hover {
        color: $main-color;
      }
    }
  }

  &.active &__content {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
