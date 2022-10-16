<template>
    <div class="article-main">
        <div class="article-toc">
            <nav class="article-catalog" v-sticky="{ zIndex: 3 }" style="position: fixed; width: 226px;">
                <div class="catalog-title">目录</div>
                <div class="catalog-body">
                <ul class="catalog-list" ref="catalog">
                    <li class="item" v-for="anchor in titles" :key="i" :style="{ padding: `10px 0 10px ${anchor.indent * 20}px` }" @click="handleAnchorClick(anchor)">
                        <div class="a-container">
                            <!-- <a style="cursor: pointer" :style="{'padding-left': (h.level - minLevel) * 16 + 8 + 'px'}" :title="h.text" class="catalog-aTag">{{h.text}}</a> -->
                            <a style="cursor: pointer">{{ anchor.title }}</a>
                        </div>
                    </li>
                </ul>
                </div>
            </nav>
        </div>
        <div id="article-info">
            <div class="summary">
                <div id="title">
                    <span>{{data.title}}</span>
                </div>
                <div id="timeInfo">
                    <span class ="timeInfo-block"> 
                        <profile-outlined />
                        <span>{{data.Category.name}}</span>
                    </span>

                    <span class ="timeInfo-block"> 
                        <field-time-outlined />
                        <span> {{data.UpdatedAt}}</span>
                    </span>
                </div>
                <div id="desc">
                    <span>{{data.desc}}</span>
                </div>
            </div>
            <div id="content">
                <v-md-preview :text="getContent" ref="preview" />
            </div>
        </div>
    </div>
</template>
<!-- 返回顶部 -->
<!-- <el-backtop target=".home-layout-main"></el-backtop> -->

<script>
import 'bytemd/dist/index.min.css';
import { defineComponent, ref, reactive } from 'vue';
import { getArticleInfo } from '@/api/article.js'
import router from '../../router'
import { useRoute} from 'vue-router'
import day from 'dayjs'
import 'bytemd/dist/index.css'
import { Viewer } from '@bytemd/vue-next';
import gfm from '@bytemd/plugin-gfm';
import highlight from '@bytemd/plugin-highlight-ssr'
import zhHans from 'bytemd/lib/locales/zh_Hans.json';
import { getProcessor } from 'bytemd'
import { visit } from 'unist-util-visit';
import VueSticky from 'vue-sticky';
// import ImageBig from '../common/ImageBig';
import { 
    FieldTimeOutlined,
    ProfileOutlined,
} from '@ant-design/icons-vue';
const plugins = [
  highlight(),
  // Add more plugins here
]
export default defineComponent({
    components: {
        FieldTimeOutlined,
        ProfileOutlined,
        Viewer,
    },
    directives: {
        'sticky': VueSticky,
    },
    data() {
        return { 
            value: '', 
            plugins, 
            zhHans, 
            hast: [], 
            titles: [],
        }
    },
    mounted() {
        const anchors = this.$refs.preview.$el.querySelectorAll('h1,h2,h3,h4,h5,h6');
        const titles = Array.from(anchors).filter((title) => !!title.innerText.trim());

        if (!titles.length) {
            this.titles = [];
            return;
        }

        const hTags = Array.from(new Set(titles.map((title) => title.tagName))).sort();

        this.titles = titles.map((el) => ({
            title: el.innerText,
            lineIndex: el.getAttribute('data-v-md-line'),
            indent: hTags.indexOf(el.tagName),
        }));
    },
    setup() {
        return {
            data: ref({}),
            id: ref(0),
            getContent: ref(""),
        }
    },

    created() {
        this.getInfo()
    },
    methods: {
        getInfo() {
            this.id = this.getRouteQuery()
            getArticleInfo(this.id).then(res => {
                res.data.UpdatedAt = res.data.UpdatedAt ? day(res.data.UpdatedAt).format('YYYY/MM/DD HH:mm') : '暂无'
                this.data = res.data
                this.getContent = res.data.content
                this.getProcessor()
            });
        },

        getRouteQuery() {
            let route = useRoute() // 第一步
            let routeQuery = route.query // 第二步
            return routeQuery.id
        },
        handleChange(v) {
            this.value = v
        },
        getProcessor() {
            const stringifyHeading = function (e) {
                let result = ''
                visit(e, (node) => {
                  if (node.type === 'text') {
                    result += node.value
                  }
                })
                return result
            }
            getProcessor({
              plugins: [
               {
               rehype: (p) => p.use(() => (tree) => {
                if (tree && tree.children.length) {
                    const items = [];
                    tree.children.filter(v => v.type === 'element').forEach((node) => {
                        if (node.tagName[0] === 'h' && !!node.children.length) {
                            const i = Number(node.tagName[1])
                            this.minLevel = Math.min(this.minLevel, i)
                            items.push({
                                level: i,
                                text: stringifyHeading(node),
                            })
                        }
                    })
                    this.hast = items.filter(v => v.level === 1 || v.level === 2 || v.level === 3);
                }
            console.log(this.hast)
               }),
              },
             ],
            }).processSync(this.getContent);
        },

        // 点击目录进行跳转 锚点
        handleAnchorClick(anchor) {
            const { preview } = this.$refs;
            const { lineIndex } = anchor;

            const heading = preview.$el.querySelector(`[data-v-md-line="${lineIndex}"]`);

            if (heading) {
                preview.scrollToTarget({
                target: heading,
                scrollContainer: window,
                top: 60,
                });
            }
        },
    },
})
</script>


<style>
    /* 目录样式 */
    .article-main {
        display: flex;
        flex-direction: row;
        margin-left: -251px;
    }
    .article-catalog {
        background: #fff;
        border-radius: 4px;
        padding: 0;
    }
    .catalog-title {
        font-weight: 500;
        padding: 0.333rem 0;
        margin: 0 1.667rem;
        font-size: 16px;
        line-height: 2rem;
        color: #1d2129;
        border-bottom: 1px solid #e4e6eb;
    }
    .catalog-body {
        box-sizing: border-box;
        font-weight: 400;
        color: #000;
        margin: 0 1.667rem;
        overflow: auto;
    }
    .catalog-list {
        position: relative;
        line-height: 22px;
        padding: 0 0 12px;
    }
    .catalog-list .item {
        color:black;
    }
    .article-toc {
        top: 0;
        right: 0;
        max-width: 25rem;
        min-width: 15rem;
        padding-right: 21px;
    }

    #article-info #title {
        font-size: 40px;
        text-align: center;
    }
    #article-info #timeInfo {
        font-size: 17px;
        text-align: center;
        border: 2px groove rgb(255 255 255 / 20%);
        border-left:none;border-right:none;
    }
    .timeInfo-block {
        margin: 0 20px;        
    }
    #article-info #desc {
        background: #f8f8f8;
        margin: 20px 0;
        padding: 10px 39px;
    }
    
    .vuepress-markdown-body:not(.custom) {
        padding: 2rem 1.5rem;
    }

    #article-info {
        /*有左侧简介时样式*/
        /* left: 71px;
        width: 500px;
        padding: 0 30px 30px 30px;
        background-color: #f9f9f9; */
        width: 800px;
        border-radius: 9px;
        margin: 0 auto;
        padding: 10px !important;
        background-color: #fffefe;
        box-shadow: inset 0 -3em 3em rgb(0 0 0 / 1%), 0 0 0 2px rgb(255 255 255), 0.3em 0.3em 1em rgb(0 0 0 / 20%);
        min-height:80vh;
        position: relative;
    }


</style>