<script setup lang="ts">
import Button from './Button.vue'

const props = defineProps<{
  onClick?: () => void
  className?: string
}>()
</script>

<template>
  <Button :onClick="props.onClick" :className="`btn-outline ${props.className || ''}`">
    <slot></slot>
  </Button>
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