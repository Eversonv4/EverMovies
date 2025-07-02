<script setup lang="ts">
import { ref, onMounted, watch } from "vue";
import { useRoute } from "vue-router";

import MovieCard from "@/components/MovieCard.vue";
import OutlineButton from "@/components/OutlineButton.vue";
import MovieSearch from "./MovieSearch.vue";

import tmdbApi, {
  category as cat,
  movieType,
  tvType,
  type Category,
} from "@/api/tmdbApi";

const route = useRoute();

const routeCategory = ref(route.params.category as Category);
const keyword = ref(route.params.keyword as string | undefined);

const items = ref<any[]>([]);
const page = ref(1);
const totalPage = ref(0);
const isLoading = ref(false);

const fetchList = async () => {
  isLoading.value = true;
  let response = null;

  try {
    if (!keyword.value) {
      const params = {} as any;
      if (routeCategory.value === cat.movie) {
        response = await tmdbApi.getMoviesList(movieType.upcoming, { params });
      } else if (routeCategory.value === "favorites") {
        const movies = await tmdbApi.getFavorites({ params });
        response = { results: movies };
      } else {
        response = await tmdbApi.getTvList(tvType.popular, { params });
      }
    } else {
      const params = { query: keyword.value };
      response = await tmdbApi.search(routeCategory.value, { params });
    }
  } catch (error) {
    response = { results: [] };
  }

  items.value = response.results;
  totalPage.value = response.total_pages ?? 0;
  page.value = 1;
  isLoading.value = false;
};

onMounted(fetchList);

watch(
  () => route.params.category,
  (newVal) => {
    routeCategory.value = newVal as Category;
    fetchList();
  }
);

watch(
  () => route.params.keyword,
  (newVal) => {
    keyword.value = newVal as string;
    fetchList();
  }
);

const loadMore = async () => {
  isLoading.value = true;
  let response = null;

  const params: any = { page: page.value + 1 };
  if (keyword.value) params.query = keyword.value;

  if (!keyword.value) {
    if (routeCategory.value === cat.movie) {
      response = await tmdbApi.getMoviesList(movieType.upcoming, { params });
    } else {
      response = await tmdbApi.getTvList(tvType.popular, { params });
    }
  } else {
    response = await tmdbApi.search(routeCategory.value, { params });
  }

  items.value.push(...response.results);
  page.value++;
  isLoading.value = false;
};
</script>

<template>
  <div class="section mb-3">
    <MovieSearch
      v-if="routeCategory !== 'favorites'"
      :category="routeCategory"
      :keyword="keyword"
    />
  </div>

  <div v-if="isLoading" class="loading-wrapper">
    <div class="spinner"></div>
  </div>

  <div v-else class="movie-grid">
    <MovieCard
      v-for="(item, i) in items"
      :key="i"
      :item="item"
      :category="routeCategory"
    />
  </div>

  <h2 v-if="!isLoading && (items.length === 0 || !items)" class="empty-list">
    You don't have any favorite movie
  </h2>

  <div v-if="!isLoading && page < totalPage" class="movie-grid__loadmore">
    <OutlineButton className="small" @click="loadMore">Load more</OutlineButton>
  </div>
</template>

<style lang="scss" scoped>
@use "../scss/" as *;

.movie-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 20px;
  margin-bottom: 3rem;

  @include tablet {
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
  }

  &__loadmore {
    text-align: center;
  }
}

.loading-wrapper {
  display: flex;
  justify-content: center;
  padding: 3rem 0;
}

.spinner {
  width: 40px;
  height: 40px;
  border: 4px solid rgba($white, 0.3);
  border-top-color: $main-color;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

.empty-list {
  text-align: center;
  color: $white;
  margin-top: 2rem;
  font-size: 1.5rem;
  font-weight: 500;
}
</style>
