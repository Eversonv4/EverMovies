import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import CatalogView from '../views/CatalogView.vue'
import DetailView from '../views/detail/DetailView.vue'
import FavoritesView from '@/views/FavoritesView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView,
  },
  {
    path: '/:category',
    name: 'catalog',
    component: CatalogView,
  },
  {
    path: '/:category/:id',
    name: 'detail',
    component: DetailView,
  },
  {
    path: '/:category/search/:keyword',
    name: 'catalog-search',
    component: CatalogView,
  },
  // {
  //   path: '/favorites',
  //   name: 'favorites',
  //   component: FavoritesView,
  // }
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
})

export default router
