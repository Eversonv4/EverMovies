<script setup lang="ts">
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import { Swiper, SwiperSlide } from "swiper/vue";
import { Autoplay } from "swiper/modules";

import Button from "@/components/Button.vue";
import OutlineButton from "@/components/OutlineButton.vue";
import Modal from "@/components/Modal.vue";
import ModalContent from "@/components/ModalContent.vue";

import tmdbApi, { category, movieType } from "@/api/tmdbApi";
import apiConfig from "@/api/apiConfig";

import "swiper/css";
import type { MovieItem } from "@/@types/movie-item";

const movieItems = ref<any[]>([]);
const modalActiveId = ref<number | null>(null);

onMounted(async () => {
  const params = { page: 1 };
  try {
    const response = await tmdbApi.getMoviesList(movieType.popular, { params });
    movieItems.value = response.results.slice(1, 8);
  } catch (err) {
    console.log("error", err);
  }
});

const router = useRouter();

const setModalActive = async (item: MovieItem) => {
  modalActiveId.value = item.id;

  const modal = document.querySelector(`#modal_${item.id}`) as HTMLElement;
  const videos = await tmdbApi.getVideos(category.movie, item.id);

  if (videos.results.length > 0) {
    const videoSrc = "https://www.youtube.com/embed/" + videos.results[0].key;
    const iframe = modal.querySelector(
      ".modal__content > iframe"
    ) as HTMLIFrameElement;
    iframe.setAttribute("src", videoSrc);
  } else {
    const content = modal.querySelector(".modal__content") as HTMLElement;
    content.innerHTML = "No trailer";
  }
};

const closeModal = (id: number) => {
  const iframe = document.querySelector(
    `#modal_${id} iframe`
  ) as HTMLIFrameElement;
  if (iframe) iframe.setAttribute("src", "");
  modalActiveId.value = null;
};
</script>

<template>
  <div class="hero-slide">
    <Swiper
      :modules="[Autoplay]"
      :grabCursor="true"
      :spaceBetween="0"
      :slidesPerView="1"
      :autoplay="{ delay: 10000, disableOnInteraction: false }"
    >
      <SwiperSlide
        v-for="(item, i) in movieItems"
        :key="i"
        v-slot="{ isActive }"
      >
        <div
          class="hero-slide__item"
          :class="{ active: isActive }"
          :style="{
            backgroundImage: `url(${apiConfig.originalImage(
              item.backdrop_path || item.poster_path
            )})`,
          }"
        >
          <div class="hero-slide__item__content container">
            <div class="hero-slide__item__content__info">
              <h2 class="title">{{ item.title }}</h2>
              <div class="overview">{{ item.overview }}</div>
              <div class="btns">
                <Button @click="router.push(`/movie/${item.id}`)"
                  >Watch now</Button
                >
                <OutlineButton @click="() => setModalActive(item)"
                  >Watch trailer</OutlineButton
                >
              </div>
            </div>
            <div class="hero-slide__item__content__poster">
              <img :src="apiConfig.w500Image(item.poster_path)" alt="" />
            </div>
          </div>
        </div>
      </SwiperSlide>
    </Swiper>

    <Modal
      v-for="(item, i) in movieItems"
      :key="`modal-${i}`"
      :id="`modal_${item.id}`"
      :active="modalActiveId === item.id"
    >
      <ModalContent :onClose="() => closeModal(item.id)">
        <iframe width="100%" height="500px" title="trailer" />
      </ModalContent>
    </Modal>
  </div>
</template>

<style lang="scss" scoped>
@use "../scss/" as *;

.hero-slide {
  margin-bottom: 3rem;
}

.hero-slide__item {
  padding: 9rem 0;
  width: 100%;
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

  &__content {
    @include flex(center, center);
    position: relative;

    &__info {
      width: 55%;
      padding: 0 3rem;
      position: relative;

      @include tablet {
        width: 100%;
      }

      & > * ~ * {
        margin-top: 3rem;
      }

      .title {
        font-size: 5rem;
        font-weight: 700;
        line-height: 1;

        @include tablet {
          font-size: 4rem;
        }
      }

      .overview {
        font-weight: 700;
      }

      .btns > * ~ * {
        margin-left: 1rem;
      }

      .btns,
      .title,
      .overview {
        opacity: 0;
        transform: translateY(-100px);
        transition: transform 0.5s ease, opacity 0.5s ease;
      }
    }

    &__poster {
      flex: 1;
      @include flex(center, flex-start);
      position: relative;

      img {
        width: 400px;
        border-radius: $border-radius;
        box-shadow: $box-shadow;

        transform: scale(0);
        transition: transform 0.7s ease;
      }

      @include tablet {
        display: none;
      }
    }
  }

  &.active > &__content > &__content__poster {
    img {
      transform: scale(1);
    }
  }

  &.active > &__content > &__content__info {
    .btns,
    .title,
    .overview {
      opacity: 1;
      transform: translateY(0);
    }

    .title {
      transition-delay: 0.3s, 0.3s;
    }

    .overview {
      transition-delay: 0.6s, 0.6s;
    }

    .btns {
      transition-delay: 0.9s, 0.9s;
    }
  }
}
</style>
