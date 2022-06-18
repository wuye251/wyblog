import { createRouter, createWebHashHistory } from 'vue-router'


const routes = [
  { 
    path: "/", 
    redirect: 'index'
  },
  {
    path: '/index',
    name: 'index',
    component: () => 
      import('../components/Index.vue'),
  },
  {
    path: '/article',
    name: 'article',
    component: () => 
      import('../components/article/List.vue'),
    children:[
      {path: 'list', component: () => import('../components/article/List.vue')},
      {path: 'info', component: () => import('../components/article/Info.vue')},
    ]  
  }
]

const router = createRouter({
  // history模式：createWebHistory , hash模式：createWebHashHistory
  history: createWebHashHistory(process.env.BASE_URL),
  routes
})

router.beforeEach((to, from) => {
  // if (to.name !== 'login') {
  //   console.log("not login and route name no 'login'")
  // } else {
  //   console.log('success login so can access other page!')
  // }
})

export default router
