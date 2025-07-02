<script setup lang="ts">
import MovieGrid from '@/components/MovieGrid.vue';

  defineProps({})
</script>

<template>
  <PageHeader>
    {{ 'Favorites' }}
  </PageHeader>
  <div class="container">
    <div class="section mb-3">
      <MovieGrid :category="'favorites'" />
    </div>
  </div>
</template>

<style lang="scss" scoped>
@use "../scss/" as *;

</style>