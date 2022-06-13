import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import Antd from 'ant-design-vue'
import ant from "./plugin/antui";
import 'ant-design-vue/dist/antd.css'
// createApp(App).use(router).use(Antd).mount('#app')
import './assets/css/style.css'



createApp(App).use(router).use(ant).mount('#app')

// import Vue from 'vue'
// import App from './App.vue'
// import router from './router'
// import axios from 'axios'
// import './plugin/antui'

// axios.defaults.baseURL = 'http://localhost:3000/api/v1'
// Vue.property.$http = axios
 
// new Vue({
//     router,
//     render: h=> h(App)
// }).$mount('#app')