import { createRouter, createWebHashHistory } from 'vue-router'
import Login from '../views/Login.vue'

const routes = [
  // { path: "/", redirect: "/index" },
  {
    path: '/login',
    name: 'login',
    component: Login
  },
  {
    path: '/admin',
    name: 'Admin',
    component: () =>
      import('../views/Admin.vue')
  },
  {
    path: '/test',
    name: 'Test',
    component: () =>
      import('../views/Test.vue')
  }
]

const router = createRouter({
  // history模式：createWebHistory , hash模式：createWebHashHistory
  history: createWebHashHistory(process.env.BASE_URL),
  routes
})

export default router
