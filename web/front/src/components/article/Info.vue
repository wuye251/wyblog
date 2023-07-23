<template>
    <div class="article-main">
        <div class="article-toc">
            <nav class="article-catalog" v-sticky="{ zIndex: 3 }" style="position: sticky; width: 226px;top: 22px">
                <div class="catalog-title">目录</div>
                <div class="catalog-body">
                <ul class="catalog-list">
                    <li class="item" v-for="(anchor,index) in titles" :style="{ fontSize: `${16 - (anchor.indent)*2}px`, padding: `0px ${anchor.indent * 10}px `}" @click="handleAnchorClick(anchor, index)">
                        <div class="a-container">
                            <a class="catalag-item" :style="{color: catalogActiveIndex === index ? '#1987e1' : '#000000'}">{{ anchor.title }}</a>
                        </div>
                    </li>
                </ul>
                </div>
            </nav>
        </div>
        <div id="article-info" v-if="articleInfo">
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
            <div id="my-content" @scroll="onScroll">
                <v-md-preview :text="content" @image-click="imgClick" ref="preview" @copy-code-success="handleCopyCodeSuccess"
                />
                <!-- 放大图片 -->
                <div v-if="isShowImg" class="imgPreview"  @click="cancleBigImg">
                    <img :src="bigImgSrc">
                </div>
            </div>
            <div style="margin-left: 30px;font-size: 18px;font-weight: 100;background: #f7f8fa;">
                <span>
                    如果大家对文章/博客站有建议,欢迎到
                    <a href="https://github.com/wuye251/wyblog/issues">github/issues</a>
                    反馈宝贵的意见☕️
                </span>
            </div>
        </div>
    </div>
</template>
<!-- 返回顶部 -->
<!-- <el-backtop target=".home-layout-main"></el-backtop> -->

<script>
import HeaderConst from '@/components/const/Header.js';
import { defineComponent, ref } from 'vue';
import { getArticleInfo } from '@/api/article.js'
import { useRoute} from 'vue-router'
import day from 'dayjs'
import VueSticky from 'vue-sticky';
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
            articleInfo: null,
            id: ref(0),
            catalogActiveIndex:0,
            isShowImg:false,
            bigImgSrc:""
        }
    },

    created() {
        this.getInfo()
        // 注册滚动事件
        let _this = this
        window.addEventListener('scroll', _this.onScroll,true);
    },
    methods: {
        // 复制代码
        handleCopyCodeSuccess(content) {
            try {
                navigator.clipboard.writeText(content);
                console.log("copy success")
            } catch(e) {
                console.log("copy failed.e:",e)
            }
        },
        
        imgClick(images, currentIndex) {
            let curImage = images[currentIndex]
            this.isShowImg = true
            this.bigImgSrc = curImage 
            const layerNode = document.querySelector('.imgPreview') 
            // 蒙层部分始终阻止默认行为
            document.body.style.overflow = 'hidden';
        },
        cancleBigImg() {
            this.isShowImg = false
            this.bigImgSrc = ""
            document.body.style.overflow = '';//出现滚动条

        },
        getInfo() {
            this.id = this.getRouteQuery()
            getArticleInfo(this.id).then(res => {
                res.data.UpdatedAt = res.data.UpdatedAt ? day(res.data.UpdatedAt).format('YYYY/MM/DD HH:mm') : '暂无'
                this.articleInfo = res.data
                this.content = res.data.content
                document.title = this.articleInfo.title + HeaderConst.HeaderPrefx
                this.$nextTick(() =>{
                    const anchors = this.$refs.preview.$el.querySelectorAll('h1,h2,h3,h4,h5,h6');
                    const titles = Array.from(anchors).filter((title) => !!title.innerText.trim());

                    if (!titles.length) {
                        this.titles = [];
                        return;
                    }

                    const hTags = Array.from(new Set(titles.map((title) => title.tagName))).sort();

                    this.titles = titles.map((el) => ({
                        title: el.innerText,
                        // TODO:这里有行数代表每个目录标题的起始行 是否可以用它来实现自动锚点
                        lineIndex: el.getAttribute('data-v-md-line'),
                        indent: hTags.indexOf(el.tagName),
                    })); 
                    // console.log("titles",this.titles)
                })
                
            });
        },

        getRouteQuery() {
            let route = useRoute() // 第一步
            let routeQuery = route.query // 第二步
            return routeQuery.id
        },
        // 点击目录进行跳转 锚点
        handleAnchorClick(anchor, index) {
            const { preview } = this.$refs;
            const { lineIndex } = anchor;
            const heading = preview.$el.querySelector(`[data-v-md-line="${lineIndex}"]`);
            if (heading) {
                preview.scrollToTarget({
                    target: heading,
                    scrollContainer: window,
                    top: 60,
                    // behavior: "smooth"//滚动的速度
                });
                this.catalogActiveIndex = index
            }
        },
        // 目录自动锚点
        onScroll(e) {
            let el = e.target.documentElement;
            const { preview } = this.$refs;
            let scrollItems = preview.$el.querySelectorAll(`[data-v-md-heading`);
            let getActiveIndex = 0
            for (let i = 0; i < scrollItems.length; i++) {
                // 判断滚动条滚动距离是否大于当前滚动项可滚动距离
                if (el.scrollTop >= scrollItems[i].offsetTop ) {
                    getActiveIndex = i
                }
            }
            this.catalogActiveIndex = getActiveIndex
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

    a:link {
	    color: gray !important;
	    text-decoration: none;
    }
    /* a:visited {
        color: blue;
    } */

    a:hover {
        text-decoration: underline;
        color: blue;

    }

    /* a:active {
        color: pink;
    } */

    .catalog-list a {
        color:inherit;
        display: inline-block;
        text-decoration: none;
        width: 100%;
        padding: 8px;
    }

    .catalog-list a:hover {
        color:inherit;
        text-decoration: none;
        background-color: #f7f8fa;
    }
    /* 图标和字的间距 */
    .summary span {
        padding: 0px 3px;
    }

    /* 图片放大 */
    .imgPreview {
        top: 0;
        left: 0px;
        width: 100%;
        height: 100%;
        position: fixed;
        background: rgba(0, 0, 0, 0.5);
        z-index: 100
    }
    .imgPreview img {
        z-index: 100;
        width: 55%;
        height: auto;
        position: fixed;
        top: 50%;
        transform: translate(-50%, -50%);
        left: 50%;
    }
</style>

