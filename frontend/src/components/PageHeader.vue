<script setup lang="ts">
import bg from '@/assets/footer-bg.jpg'
</script>

<template>
  <div class="page-header" :style="{ backgroundImage: `url(${bg})` }">
    <h2><slot></slot></h2>
  </div>
</template>

<style lang="scss" scoped>
@use "../scss/variables" as *;

.page-header {
    padding: $header-height 0 2rem;
    text-align: center;
    margin-bottom: 2rem;

    position: relative;

    background-position: top;
    background-size: cover;
    background-repeat: no-repeat;

    h2 {
        position: relative;
        z-index: 99;
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

</style>