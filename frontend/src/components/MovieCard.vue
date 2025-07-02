<script setup lang="ts">
import { computed } from "vue";
import { RouterLink, useRoute, useRouter } from "vue-router";

import Button from "@/components/Button.vue";
import apiConfig from "@/api/apiConfig";
import tmdbApi, { category as categoryMap, type Category } from "@/api/tmdbApi";
import type { MovieItem } from "@/@types/movie-item";

const props = defineProps<{
  item: MovieItem;
  category: Category;
}>();

import { ref } from "vue";

const route = useRoute();
const router = useRouter();

const routeCategory = ref(route.params.category as Category);
const isLoading = ref(false);

const link = computed(() => `/${categoryMap[props.category]}/${props.item.id}`);
const bg = computed(() =>
  apiConfig.w500Image(props.item.poster_path || props.item.backdrop_path)
);

const handleSubmit = () => {
  if (routeCategory.value === "favorites") {
    removeFromFavorites();
  } else {
    addToFavorites();
  }
};

const removeFromFavorites = async () => {
  isLoading.value = true;
  try {
    await tmdbApi.removeFromFavorite(props.item.movie_id || props.item.id);
    alert("Removed from favorites successfully!✅");
    window.location.reload();
  } catch (error) {
    console.error("Failed to remove from favorites:", error);
    alert("Failed to remove from favorites. Please try again later.❌");
  } finally {
    isLoading.value = false;
  }
};

const addToFavorites = async () => {
  isLoading.value = true;
  try {
    await tmdbApi.addToFavorite(props.item);
    alert("Added to favorites successfully!✅");
  } catch (error) {
    console.error("Failed to add to favorites:", error);
    alert("Failed to add to favorites. Please try again later.❌");
  } finally {
    isLoading.value = false;
  }
};
</script>

<template>
  <v-partial>
    <RouterLink :to="link">
      <div class="movie-card" :style="{ backgroundImage: `url(${bg})` }">
        <Button>
          <i class="bx bx-play"></i>
        </Button>
      </div>
    </RouterLink>
    <div class="movie-card__content">
      <h3>{{ props.item.title || props.item.name }}</h3>
      <span @click="handleSubmit">
        Favorite
        <i v-if="!isLoading && routeCategory !== 'favorites'" title="Add to favorites" class="bx bxs-heart"></i>
        <i v-if="!isLoading && routeCategory === 'favorites'" class='bx  bxs-trash'></i>
        <div v-if="isLoading" class="spinner"></div>
      </span>
    </div>
  </v-partial>
</template>

<style lang="scss" scoped>
@use "../scss/" as *;

.movie-card {
  position: relative;
  background-position: top;
  background-repeat: no-repeat;
  background-size: cover;
  padding-top: 160%;
  border-radius: $border-radius;
  margin-bottom: 1rem;

  &__content {
    color: $white;

    h3 {
      margin: 0;
      font-size: 1rem;
      font-weight: 500;
      line-height: 1;
      text-overflow: ellipsis;
      overflow: hidden;
      white-space: nowrap;
    }

    span {
      @include flex(center, flex-end);
      display: flex;
      color: $main-color;
      font-weight: 500;
      border: 1px solid $main-color;
      width: fit-content;
      margin-left: auto;
      padding: 0.2rem 0.5rem;
      border-radius: $border-radius;
      margin-top: 0.5rem;
      cursor: pointer;

      i {
        font-size: 1.4rem;
        margin-left: 0.5rem;
        margin-top: 0.2rem;
      }

      .spinner {
        width: 16px;
        height: 16px;
        border: 1px solid rgba($white, 0.3);
        border-top-color: $main-color;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-left: 5px;
      }

      &:hover {
        background-color: $main-color;
        color: $black;

        .spinner {
          border-top-color: $black;
        }
      }
    }
  }

  .btn {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  &::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background-color: $black;
    opacity: 0;
    transition: opacity 0.3s ease;
    border-radius: $border-radius;
  }

  @media (hover: hover) and (pointer: fine) {
    &:hover::before {
      opacity: 0.8;
    }

    &:hover .btn {
      transform: translate(-50%, -50%) scale(1);
    }
  }
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}
</style>
