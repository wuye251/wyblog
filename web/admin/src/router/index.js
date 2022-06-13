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
            import ('../views/Admin.vue')
    }
]

const router = createRouter({
    //history模式：createWebHistory , hash模式：createWebHashHistory
    history: createWebHashHistory(process.env.BASE_URL),
    routes
})

export default router
// import VueRouter from 'vue-router'
// import { createApp } from 'vue'
// import Login from '../views/Login.vue'
// import Admin from '../views/Admin.vue'

// Vue.use(VueRouter)

// const routes = [
//   {
//     path: '/login',
//     name: 'login',
//     component: Login
//   },
//   {
//     path: '/admin',
//     name: 'admin',
//     component: Admin
//   }
// ]

// const router = new VueRouter({
//   routes
// })

// export default router

