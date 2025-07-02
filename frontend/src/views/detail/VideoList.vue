<script setup lang="ts">
import { ref, watchEffect } from 'vue'
import { useRoute } from 'vue-router'

import tmdbApi, { type Category } from '../../api/tmdbApi'
import Video from './Video.vue'

const props = defineProps<{ id: number | string }>()

const route = useRoute()
const videos = ref([] as Array<{ name: string; key: string }>)

const fetchVideos = async () => {
  if (!route.params.category || !props.id) return
  const res = await tmdbApi.getVideos(route.params.category as Category, props.id)
  videos.value = res.results.slice(0, 5)
}

watchEffect(() => {
  fetchVideos()
})
</script>

<template>
  <div>
    <Video v-for="(item, i) in videos" :key="i" :item="item" />
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
