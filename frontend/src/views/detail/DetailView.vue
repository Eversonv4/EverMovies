<script setup lang="ts">
import { ref, watchEffect, onMounted } from 'vue'
import { useRoute } from 'vue-router'

import tmdbApi, { type Category } from '../../api/tmdbApi'
import apiConfig from '../../api/apiConfig'

import CastList from './CastList.vue'
import VideoList from './VideoList.vue'
import MovieList from '@/components/MoviesList.vue'
import type { ParamsProps } from '@/@types/params-props'

const route = useRoute()

const item: any = ref(null)

const fetchDetail = async () => {
  if (!route.params.category || !route.params.id) return
  const response = await tmdbApi.detail(
    route.params.category as Category,
    route.params.id as string,
    { params: {} } as ParamsProps
  )
  item.value = response
  window.scrollTo(0, 0)
}

onMounted(() => {
  fetchDetail()
})

watchEffect(() => {
  // Recarregar quando mudar category ou id
  fetchDetail()
})
</script>

<template>
  <div v-if="item">
    <div
      class="banner"
      :style="{ backgroundImage: `url(${apiConfig.originalImage(item.backdrop_path || item.poster_path)})` }"
    ></div>
    <div class="mb-3 movie-content container">
      <div class="movie-content__poster">
        <div
          class="movie-content__poster__img"
          :style="{ backgroundImage: `url(${apiConfig.originalImage(item.poster_path || item.backdrop_path)})` }"
        ></div>
      </div>
      <div class="movie-content__info">
        <h1 class="title">{{ item.title || item.name }}</h1>
        <div class="genres">
          <span
            v-for="(genre, i) in item.genres?.slice(0, 5)"
            :key="i"
            class="genres__item"
          >
            {{ genre.name }}
          </span>
        </div>
        <p class="overview">{{ item.overview }}</p>
        <div class="cast">
          <div class="section__header">
            <h2>Casts</h2>
          </div>
          <CastList :id="item.id" />
        </div>
      </div>
    </div>
    <div class="container">
      <div class="section mb-3">
        <VideoList :id="item.id" />
      </div>
      <div class="section mb-3">
        <div class="section__header mb-2">
          <h2>Similar</h2>
        </div>
        <MovieList
          :category="route.params.category as Category"
          type="similar"
          :id="item.id"
        />
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
@use "../../scss/" as *;

.banner {
    height: 50vh;
    position: relative;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;

    &::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        @include overlay();
    }

    &::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100px;
        background-image: linear-gradient(to top, $body-bg, rgba($black, 0));
    }
}

.movie-content {
    @include flex(flex-start, flex-start);
    max-width: 1260px;
    margin-left: auto;
    margin-right: auto;
    margin-top: -200px;
    position: relative;
    padding: 0 2rem;

    &__poster {
        flex: 1;

        @include mobile {
            display: none;
        }

        &__img {
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            border-radius: $border-radius;
            padding-top: 165%;
        }
    }

    &__info {
        width: 70%;
        padding-left: 2rem;
        position: relative;

        @include mobile {
            width: 100%;
            padding-left: 0;
        }

        & > * {
            margin-bottom: 2rem;
        }

        .title {
            font-size: 4rem;
            line-height: 1;
        }

        .genres {
            & > * ~ * {
                margin-left: 0.5rem;
            }

            &__item {
                padding: 0.5rem 1.5rem;
                border: 2px solid $white;
                border-radius: $border-radius;
                font-size: 0.8rem;
                font-weight: 600;
                background-color: $body-bg;
            }
        }
    }
}

.casts {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
    gap: 10px;

    &__item {
        &__img {
            padding-top: 160px;
            background-size: cover;
            margin-bottom: 0.5rem;
        }

        &__name {
            font-size: 0.8rem;
        }
    }
}

.video {
    margin-bottom: 3rem;

    &__title {
        margin-bottom: 1.5rem;
    }
}

</style>