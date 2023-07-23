import { createRouter, createWebHashHistory } from 'vue-router'
import HeaderConst from "@/components/const/Header"
const ArticleInfo = () => import('../components/article/Info.vue')
const ArticleList = () => import('../components/article/List.vue')

const routes = [
  { 
    path: "/", 
    component: ArticleList,
    meta: {
      keepAlive: true, // 需要被缓存
      title: '首页' + HeaderConst.HeaderPrefx,
    }
  },
  {
    path: '/index',
    name: 'Index',
    component: ArticleList,
    meta: {
      keepAlive: true, // 需要被缓存
      title: '文章列表' + HeaderConst.HeaderPrefx,
    }
  },
  {
    path: '/article',
    name: 'Article',
    component: ArticleList,
    meta: {
      keepAlive: true, // 需要被缓存
      title: '文章列表' + HeaderConst.HeaderPrefx,
    }
    // children:[
    //   {path:'info', component: ArticleInfo},

    //   {path:'list',  component: ArticleList},
    // ]
  },
  {
    path:'/article/info',
    name: 'ArticleInfo',
    component: ArticleInfo,
    meta: {
      keepAlive: true, // 需要被缓存
      title: '文章详情'+ HeaderConst.HeaderPrefx,
    }
  },
  {
    path:'/article/list',
    name: 'ArticleList',
    component: ArticleList,
    meta: {
      keepAlive: true, // 需要被缓存
      title: '文章列表' + HeaderConst.HeaderPrefx,
    }
  },

]

const router = createRouter({
  // history模式：createWebHistory , hash模式：createWebHashHistory
  history: createWebHashHistory(process.env.BASE_URL),
  routes
})

router.beforeEach((to, from) => {
  if (to.meta.title) {
    document.title = to.meta.title
  }
})

router.afterEach((to, from, next) => {
  window,scrollTo(0,0)
})

export default router
