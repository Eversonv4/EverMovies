<script setup lang="ts">
import { defineEmits, defineProps } from "vue";

const props = defineProps<{
  type?: string;
  placeholder?: string;
  modelValue?: string;
}>();

const emit = defineEmits<{
  (e: "update:modelValue", value: string): void;
  (e: "change", value: Event): void;
}>();

const onInput = (e: Event) => {
  const target = e.target as HTMLInputElement;
  emit("update:modelValue", target.value);
  emit("change", e);
};
</script>

<template>
  <input
    :type="props.type || 'text'"
    :placeholder="props.placeholder"
    :value="props.modelValue"
    @input="onInput"
  />
</template>

<style lang="scss" scoped>
@use "../scss/variables" as *;

input {
  border: 0;
  background-color: $black;
  padding: 0.5rem 1.5rem;
  font-size: 1rem;
  border-radius: $border-radius;
  color: $txt-color;
  font-family: $font-family;
}
</style>
