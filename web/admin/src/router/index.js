import { createRouter, createWebHashHistory } from 'vue-router'
import Login from '../views/Login.vue'
import { getToken } from '@/utils/auth'

//页面路由组件
import DashBoard from '../components/admin/DashBoard.vue'
import ArticlList from '../components/article/List.vue'
import AddArticle from '../components/article/Add.vue'
import CategoryList from '../components/category/List.vue'
import UserList from '../components/user/List.vue'

const routes = [
  // { path: "/", redirect: "/index" },
  {
    path: '/login',
    name: 'login',
    component: Login
  },
  {
    path: '/',
    name: 'Admin',
    component: () =>
      import('../views/Admin.vue'),
    children:[
      {path:'dashboard', component: DashBoard},
      {path:'add-article', component: AddArticle},
      {path:'article-list', component: ArticlList},
      {path:'category-list', component: CategoryList},
      {path:'user-list', component: UserList},
    ]
  },
  {
    path: '/test',
    name: 'Test',
    component: () =>
      import('../views/Test.vue')
  },
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
