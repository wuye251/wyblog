import { createRouter, createWebHashHistory } from 'vue-router'
// import ArticleInfo from '../components/article/Info.vue'
// import ArticleList from '../components/article/List.vue'

const ArticleInfo = () => import('../components/article/Info.vue')
const ArticleList = () => import('../components/article/List.vue')

const routes = [
  { 
    path: "/", 
    component: ArticleList,
  },
  {
    path: '/index',
    name: 'Index',
    component: ArticleList,
  },
  {
    path: '/article',
    name: 'Article',
    component: () =>
      ArticleList,
    // children:[
    //   {path:'info', component: ArticleInfo},

    //   {path:'list',  component: ArticleList},
    // ]
  },
  {
    path:'/article/info',
    name: 'ArticleInfo',
    component: ArticleInfo,
  },
  {
    path:'/article/list',
    name: 'ArticleList',
    component: ArticleList
  },

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

router.afterEach((to, from, next) => {
  window,scrollTo(0,0)
})

export default router
