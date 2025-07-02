<script setup lang="ts">
import { ref, onMounted } from "vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import tmdbApi, {
  category as categoryConst,
  type Category,
} from "@/api/tmdbApi";
import MovieCard from "@/components/MovieCard.vue";

const props = defineProps<{
  category: Category;
  type: any;
  id?: string | number;
}>();

const items = ref<any[]>([]);
const isLoading = ref(false);

onMounted(async () => {
  isLoading.value = true;
  let response = null;
  const params = {} as any;

  try {
    if (props.type !== "similar") {
      if (props.category === categoryConst.movie) {
        response = await tmdbApi.getMoviesList(props.type, { params });
      } else {
        response = await tmdbApi.getTvList(props.type, { params });
      }
    } else {
      response = await tmdbApi.similar(props.category, props.id ?? 0);
    }
  } catch (error) {
    response = { results: [] };
  }

  items.value = response.results;
  isLoading.value = false;
});
</script>

<template>
  <div class="movie-list">
    <Swiper :grabCursor="true" :spaceBetween="10" slidesPerView="auto">
      <div v-if="isLoading" class="loading-wrapper">
        <div class="spinner"></div>
      </div>
      <SwiperSlide v-else v-for="(item, i) in items" :key="i">
        <MovieCard :item="item" :category="category" />
      </SwiperSlide>
    </Swiper>

    <h2 v-if="!isLoading && (items.length === 0 || !items)" class="empty-list">
      Fail to fetch movies. Please try again later.
    </h2>
  </div>
</template>

<style lang="scss" scoped>
@use "../scss/" as *;

.movie-list {
  .swiper-slide {
    width: 15%;

    @include tablet {
      width: 30%;
    }

    @include mobile {
      width: 40%;
    }
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
