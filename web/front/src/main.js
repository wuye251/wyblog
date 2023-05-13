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
// import Prism from "prismjs"
// 快速复制代码
import createCopyCodePlugin from '@kangc/v-md-editor/lib/plugins/copy-code/index';
import '@kangc/v-md-editor/lib/plugins/copy-code/copy-code.css';
// 显示代码行数
import createLineNumbertPlugin from '@kangc/v-md-editor/lib/plugins/line-number/index';

import Prism  from './prism';
import './prism.css'

// Prism.manual = true;
// Prism.highlightAll();

VMdPreview.use(vuepressTheme, {
    Prism,  
}).use(createCopyCodePlugin())
.use(createLineNumbertPlugin())

createApp(App).use(router).use(Antd).use(VMdPreview).mount('#app')