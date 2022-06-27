import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import Antd  from 'ant-design-vue/es'
import 'ant-design-vue/dist/antd.css'
//markdown
import VMdPreview from '@kangc/v-md-editor/lib/preview';
import '@kangc/v-md-editor/lib/style/preview.css';
import vuepressTheme from '@kangc/v-md-editor/lib/theme/vuepress.js';
import '@kangc/v-md-editor/lib/theme/style/vuepress.css';
import Prism from 'prismjs';


VMdPreview.use(vuepressTheme, {
    Prism,
});

  
createApp(App).use(router).use(Antd).use(VMdPreview).mount('#app')