<script setup lang="ts">
import { ref, watch, onMounted, onUnmounted } from "vue";
import { useRouter } from "vue-router";

import Button from "@/components/Button.vue";
import Input from "@/components/Input.vue";

import { category as cat, type Category } from "@/api/tmdbApi";

const props = defineProps<{
  category: Category;
  keyword?: string;
}>();

const router = useRouter();
const keyword = ref(props.keyword || "");

const goToSearch = () => {
  if (keyword.value.trim().length > 0) {
    router.push(`/${cat[props.category]}/search/${keyword.value}`);
  }
};

const enterEvent = (e: KeyboardEvent) => {
  if (e.key === "Enter") {
    e.preventDefault();
    goToSearch();
  }
};

onMounted(() => {
  document.addEventListener("keyup", enterEvent);
});

onUnmounted(() => {
  document.removeEventListener("keyup", enterEvent);
});
</script>

<template>
  <div class="movie-search">
    <Input type="text" placeholder="Enter keyword" v-model="keyword" />
    <Button className="small" @click="goToSearch">Search</Button>
  </div>
</template>

<style lang="scss" scoped>
@use "../scss/" as *;

.movie-search {
  position: relative;
  width: 100%;
  max-width: 500px;

  input {
    width: 100%;
    padding-right: 8rem;
  }

  button {
    position: absolute;
    right: 0;
    top: 2px;

    @include mobile {
      right: 1px;
      top: 1px;
    }
  }
}
</style>
