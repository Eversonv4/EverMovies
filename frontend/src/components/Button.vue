<script setup lang="ts">
const props = defineProps<{
  onClick?: () => void;
  className?: string;
}>();

const emit = defineEmits<{
  (e: "click"): void;
}>();

const handleClick = () => {
  if (props.onClick) props.onClick();
  emit("click");
};
</script>

<template>
  <button :class="`btn ${props.className || ''}`" @click="handleClick">
    <slot></slot>
  </button>
</template>

<style lang="scss" scoped>
@use "../scss/" as *;

button {
  cursor: pointer;
  font-family: $font-family;
}

.btn {
  border: 4px solid transparent;
  background-color: $main-color;
  color: $white;
  border-radius: $border-radius;
  padding: 0.5rem 1.8rem;
  font-size: 1.5rem;
  font-weight: 600;
  box-shadow: 0px 0px 7px 8px #ff00004d;
  transition: box-shadow 0.3s ease;
  position: relative;
}

.btn:hover {
  box-shadow: 0px 0px 7px 15px #ff00004d;
}

.btn-outline {
  border: 3px solid $white;
  background-color: transparent;
  color: $white;
  box-shadow: unset;
  transition: color 0.3s ease, background-color 0.3s ease;
}

.btn-outline:hover {
  box-shadow: unset;
  color: $main-color;
  background-color: $white;
}

.btn.small {
  border-width: 2px;
  padding: 0.25rem 1.5rem;
  font-size: 1rem;
}
</style>
