<template>
    <div class="article-main">
        <div class="article-toc">
            <nav class="article-catalog" v-sticky="{ zIndex: 3 }" style="position: fixed; width: 226px;">
                <div class="catalog-title">目录</div>
                <div class="catalog-body">
                <ul class="catalog-list">
                    <li class="item" v-for="anchor in titles" :style="{ padding: `10px 0 10px ${anchor.indent * 20}px` }" @click="handleAnchorClick(anchor)">
                        <div class="a-container">
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
                    <span>{{ articleInfo.title }}</span>
                </div>
                <div id="timeInfo">
                    <span class ="timeInfo-block"> 
                        <profile-outlined />
                        <span>{{ articleInfo.Category.name }}</span>
                    </span>

                    <span class ="timeInfo-block"> 
                        <field-time-outlined />
                        <span> {{ articleInfo.UpdatedAt }}</span>
                    </span>
                </div>
                <div id="desc">
                    <span>{{ articleInfo.desc }}</span>
                </div>
            </div>
            <div id="my-content">
                <v-md-preview :text="content" ref="preview" />
            </div>
        </div>
    </div>
</template>
<!-- 返回顶部 -->
<!-- <el-backtop target=".home-layout-main"></el-backtop> -->

<script>
import { defineComponent, ref, reactive } from 'vue';
import { getArticleInfo } from '@/api/article.js'
import router from '../../router'
import { useRoute} from 'vue-router'
import day from 'dayjs'
import { visit } from 'unist-util-visit';
import VueSticky from 'vue-sticky';
// import ImageBig from '../common/ImageBig';
import { 
    FieldTimeOutlined,
    ProfileOutlined,
} from '@ant-design/icons-vue';

export default defineComponent({
    components: {
        FieldTimeOutlined,
        ProfileOutlined,
    },
    directives: {
        'sticky': VueSticky,
    },
    data() {
        return { 
            titles: [],
            content: '',
            articleInfo: {},
            id: ref(0),
        }
    },
    mounted() {
            console.log(this.$refs, "   refs")
            console.log(this.$refs.preview, "  preview")
            console.log(this.$refs.preview.$el, "  el")
            const anchors = this.$refs.preview.$el.querySelectorAll('h1,h2,h3,h4,h5,h6');
            const titles = Array.from(anchors).filter((title) => !!title.innerText.trim());
            console.log(anchors, "  anchors")
            console.log(titles, "  titles")

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
    // setup() {
    //     return {
    //         articleInfo: ref({}),
    //         id: ref(0),
    //     }
    // },

    created() {
        this.getInfo()
    },
    methods: {
        getInfo() {
            this.id = this.getRouteQuery()
            getArticleInfo(this.id).then(res => {
                res.data.UpdatedAt = res.data.UpdatedAt ? day(res.data.UpdatedAt).format('YYYY/MM/DD HH:mm') : '暂无'
                this.articleInfo = res.data
                this.content = res.data.content
            });
        },

        getRouteQuery() {
            let route = useRoute() // 第一步
            let routeQuery = route.query // 第二步
            return routeQuery.id
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

