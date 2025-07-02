<script setup lang="ts">
import { useRoute } from 'vue-router'
import { computed } from 'vue'

import PageHeader from '@/components/PageHeader.vue'
import MovieGrid from '@/components/MovieGrid.vue'

import { category as cate, type Category } from '@/api/tmdbApi'

const route = useRoute()
const category = computed(() => route.params.category as Category)
</script>

<template>
  <PageHeader>
    {{ category === cate.movie ? 'Movies' : '' }}
    {{ category === cate.tv ? 'TV Series' : '' }}
    {{ category === cate.favorites ? 'Favorites' : ''}}
  </PageHeader>

  <div class="container">
    <div class="section mb-3">
      <MovieGrid :category="category" />
    </div>
  </div>
</template>
