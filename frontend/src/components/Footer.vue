<script setup lang="ts">
import { useRouter } from "vue-router";
import bg from "@/assets/footer-bg.jpg";
import logo from "@/assets/logo.png";

const router = useRouter();

const navigate = (path: string) => {
  router.push(path);
};
</script>

<template>
  <div class="footer" :style="{ backgroundImage: `url(${bg})` }">
    <div class="footer__content container">
      <div class="footer__content__logo">
        <div class="logo" @click="navigate('/')">
          <img :src="logo" alt="" />
          <span>EverMovies</span>
        </div>
      </div>
      <div class="footer__content__menus">
        <div class="footer__content__menu">
          <span @click="navigate('/')">Home</span>
          <span @click="navigate('/')">Contact us</span>
          <span @click="navigate('/')">Term of services</span>
          <span @click="navigate('/')">About us</span>
        </div>
        <div class="footer__content__menu">
          <span @click="navigate('/')">Live</span>
          <span @click="navigate('/')">FAQ</span>
          <span @click="navigate('/')">Premium</span>
          <span @click="navigate('/')">Privacy policy</span>
        </div>
        <div class="footer__content__menu">
          <span @click="navigate('/')">You must watch</span>
          <span @click="navigate('/')">Recent release</span>
          <span @click="navigate('/')">Top IMDB</span>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
@use "../scss/" as *;

.footer {
  position: relative;
  padding: 6rem 2rem;
  background-position: top;
  background-size: cover;
  background-repeat: no-repeat;

  &__content {
    max-width: 1000px;

    &__logo {
      @include flex(center, center);
      margin-bottom: 3rem;

      img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
      }

      span {
        font-size: 2rem;
        font-weight: 600;
        margin-left: 1rem;
      }
    }

    &__menus {
      display: grid;
      grid-template-columns: repeat(3, 1fr);

      @include mobile {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    &__menu {
      @include flex(flex-start, flex-start);
      flex-direction: column;
      margin-top: 1rem;

      font-size: 1.5rem;
      font-weight: 600;

      & > * ~ * {
        margin-top: 1rem;
      }
    }
  }
}
</style>
