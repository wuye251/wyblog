import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import Antd  from 'ant-design-vue/es'
import ant from './plugin/antui'
import 'ant-design-vue/dist/antd.css'
import './assets/css/style.css'

//markdown插件
import VMdEditor from '@kangc/v-md-editor/lib/codemirror-editor';
import '@kangc/v-md-editor/lib/style/codemirror-editor.css';
//主题
// import githubTheme from '@kangc/v-md-editor/lib/theme/github.js';
import '@kangc/v-md-editor/lib/theme/style/github.css';

import vuepressTheme from '@kangc/v-md-editor/lib/theme/vuepress.js';
import '@kangc/v-md-editor/lib/theme/style/vuepress.css';
import Prism from 'prismjs';
//行号
import createLineNumbertPlugin from '@kangc/v-md-editor/lib/plugins/line-number/index';
//高亮
// import createHighlightLinesPlugin from '@kangc/v-md-editor/lib/plugins/highlight-lines/index';
import '@kangc/v-md-editor/lib/plugins/highlight-lines/highlight-lines.css';
//提示

// highlightjs
// import hljs from 'highlight.js';

// codemirror 编辑器的相关资源
import Codemirror from 'codemirror';
// mode
import 'codemirror/mode/markdown/markdown';
import 'codemirror/mode/javascript/javascript';
import 'codemirror/mode/css/css';
import 'codemirror/mode/htmlmixed/htmlmixed';
import 'codemirror/mode/vue/vue';
// edit
import 'codemirror/addon/edit/closebrackets';
import 'codemirror/addon/edit/closetag';
import 'codemirror/addon/edit/matchbrackets';
// placeholder
import 'codemirror/addon/display/placeholder';
// active-line
import 'codemirror/addon/selection/active-line';
// scrollbar
import 'codemirror/addon/scroll/simplescrollbars';
import 'codemirror/addon/scroll/simplescrollbars.css';
// style
import 'codemirror/lib/codemirror.css';

VMdEditor.Codemirror = Codemirror;
VMdEditor.use(vuepressTheme, {
    Prism,
})
// .use(createTipPlugin()) //::: tip  提示内容 :::
.use(createLineNumbertPlugin()); //行号

//   }).use(createEmojiPlugin()) //表情



createApp(App).use(router).use(Antd).use(ant).use(VMdEditor).mount('#app')
