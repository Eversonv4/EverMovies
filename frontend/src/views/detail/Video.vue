<script setup lang="ts">
import { ref, onMounted } from 'vue'

const props = defineProps<{ item: { name: string; key: string } }>()

const iframeRef = ref<HTMLIFrameElement | null>(null)

onMounted(() => {
  if (iframeRef.value) {
    const width = iframeRef.value.offsetWidth
    const height = (width * 9) / 16
    iframeRef.value.height = height.toString()
  }
})
</script>

<template>
  <div class="video">
    <div class="video__title">
      <h2>{{ props.item.name }}</h2>
    </div>
    <iframe
      :src="`https://www.youtube.com/embed/${props.item.key}`"
      ref="iframeRef"
      width="100%"
      title="video"
    ></iframe>
  </div>
</template>

<style lang="scss" scoped>
@use "../../scss/" as *;
.video {
    margin-bottom: 3rem;

    &__title {
        margin-bottom: 1.5rem;
    }
}
</style>
