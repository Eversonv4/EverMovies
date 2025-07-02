<script setup lang="ts">
import { RouterLink } from 'vue-router'

import HeroSlide from '@/components/HeroSlide.vue'
import MovieList from '@/components/MoviesList.vue'
import OutlineButton from '@/components/OutlineButton.vue'

import { category, movieType, tvType } from '@/api/tmdbApi'
</script>

<template>
  <div>
    <HeroSlide />

    <div class="container">
      <!-- Trending Movies -->
      <div class="section mb-3">
        <div class="section__header mb-2">
          <h2>Trending Movies</h2>
          <RouterLink to="/movie">
            <OutlineButton class="small">View more</OutlineButton>
          </RouterLink>
        </div>
        <MovieList :category="category.movie" :type="movieType.popular" />
      </div>

      <!-- Top Rated Movies -->
      <div class="section mb-3">
        <div class="section__header mb-2">
          <h2>Top Rated Movies</h2>
          <RouterLink to="/movie">
            <OutlineButton class="small">View more</OutlineButton>
          </RouterLink>
        </div>
        <MovieList :category="category.movie" :type="movieType.top_rated" />
      </div>

      <!-- Trending TV -->
      <div class="section mb-3">
        <div class="section__header mb-2">
          <h2>Trending TV</h2>
          <RouterLink to="/tv">
            <OutlineButton class="small">View more</OutlineButton>
          </RouterLink>
        </div>
        <MovieList :category="category.tv" :type="tvType.popular" />
      </div>

      <!-- Top Rated TV -->
      <div class="section mb-3">
        <div class="section__header mb-2">
          <h2>Top Rated TV</h2>
          <RouterLink to="/tv">
            <OutlineButton class="small">View more</OutlineButton>
          </RouterLink>
        </div>
        <MovieList :category="category.tv" :type="tvType.top_rated" />
      </div>
    </div>
  </div>
</template>