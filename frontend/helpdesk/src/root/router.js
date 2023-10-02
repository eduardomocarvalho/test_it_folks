import { createWebHistory, createRouter } from "vue-router";

import LoginView from '../modules/login/LoginView.vue'
import HomeView from '../modules/home/HomeView.vue'
const routes = [
  {
    path: '/',
    name: 'login',
    component: LoginView
  },
  {
    path: '/home',
    name: 'home',
    component: HomeView
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
