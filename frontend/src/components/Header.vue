<script setup lang="ts">
import { ref, onMounted, onUnmounted, computed } from "vue";
import { useRoute, useRouter } from "vue-router";

const headerRef = ref<HTMLElement | null>(null);
const route = useRoute();

const headerNav = [
  { display: "Home", path: "/", },
  { display: "Movies", path: "/movie", },
  { display: "TV Series", path: "/tv", },
  { display: "Favorites", path: "/favorites", },
];

const activeIndex = computed(() =>
  headerNav.findIndex((e) => e.path === route.path)
);

const shrinkHeader = () => {
  if (
    document.body.scrollTop > 100 ||
    document.documentElement.scrollTop > 100
  ) {
    headerRef.value?.classList.add("shrink");
  } else {
    headerRef.value?.classList.remove("shrink");
  }
};

onMounted(() => {
  window.addEventListener("scroll", shrinkHeader);
});

onUnmounted(() => {
  window.removeEventListener("scroll", shrinkHeader);
});
</script>

<template>
  <div ref="headerRef" class="header">
    <div class="header__wrap container">
      <div class="logo">
        <img src="@/assets/logo.png" alt="" />
        <RouterLink to="/">EverMovies</RouterLink>
      </div>
      <ul class="header__nav">
        <li
          v-for="(item, i) in headerNav"
          :key="i"
          :class="{ active: i === activeIndex }"
        >
          <RouterLink :to="item.path">{{ item.display }}</RouterLink>
        </li>
      </ul>
    </div>
  </div>
</template>

<style lang="scss" scoped>
@use "../scss/" as *;

.logo {
  font-size: 2.5rem;
  font-weight: 600;

  @include flex(center, unset);

  img {
    margin-right: 10px;
    width: 50px;
    border-radius: 50%;

    @include mobile {
      width: 30px;
      margin-right: 0;
    }
  }
}

.header {
  height: $header-height;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 99;
  transition: height 0.3s ease, background-color 0.3s ease;

  &.shrink {
    height: $header-shrink-height;
    background-color: $body-bg;
  }

  &__wrap {
    @include flex(center, space-between);
    height: 100%;
    padding: 0 2rem;

    @include mobile {
      justify-content: center;
    }
  }

  &__nav {
    @include flex(center, unset);

    & > * ~ * {
      margin-left: 2rem;
    }

    li {
      padding: 5px 0;
      font-weight: 700;
      position: relative;
      font-size: 1.5rem;

      &::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        transition: width 0.5s ease;
        height: 2px;
        background-color: $main-color;
      }

      &.active::after,
      &:hover::after {
        width: 100%;
      }
    }

    @include mobile {
      position: fixed;
      bottom: 0;
      left: 0;
      height: 5rem;
      width: 100%;
      background-color: $body-bg;
      padding: 0 2rem;
      box-shadow: $box-shadow;

      @include flex(center, space-between);

      & > * ~ * {
        margin-left: 0;
      }
    }
  }
}
</style>
