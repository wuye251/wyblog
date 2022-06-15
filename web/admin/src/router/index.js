import { createRouter, createWebHashHistory } from 'vue-router'
import Login from '../views/Login.vue'
import { getToken } from '@/utils/auth'

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

router.beforeEach((to, from) => {
  const token = getToken()
  console.log(token)
  if(to.name != 'login' && !token) {
    console.log("not login and route name no 'login'")
    return {
      name:'login'
    }
  } else {
    console.log('success login so can access other page!')
  }
})

export default router
