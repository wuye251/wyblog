import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import Antd, { message } from 'ant-design-vue/es'
import ant from './plugin/antui'
import 'ant-design-vue/dist/antd.css'
import './assets/css/style.css'

createApp(App).use(router).use(Antd).use(message).use(ant).mount('#app')
