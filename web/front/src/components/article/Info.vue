<template>
    <div  id="article-info">
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
            <v-md-preview :text="getContent"></v-md-preview>
        </div>
    </div>
</template>

<style>
    
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
</style>

<script>
import { defineComponent, ref, reactive } from 'vue';
import { getArticleInfo } from '@/api/article.js'
import router from '../../router'
import { useRoute} from 'vue-router'
import day from 'dayjs'
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
    setup() {
        return {
            data: ref({}),
            id: ref(0),
            getContent: ref(""),
            markdown: '### 标题',
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
            })
        },
        getRouteQuery() {
            let route = useRoute() // 第一步
            let routeQuery = route.query // 第二步
            return routeQuery.id
        }
    },


})
</script>