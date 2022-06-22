<template>
    <div  id="article-info">
        <div id="title">
            {{data.title}}
        </div>
        <div id="timeInfo">
            最近更新:{{data.UpdatedAt}}
            分类:{{data.Category.name}}
        </div>
        <div id="desc">
            {{data.desc}}
        </div>
        <div id="content">
            <v-md-preview :text="getContent"></v-md-preview>
            <v-md-preview :text="markdown"></v-md-preview>
        </div>
    </div>
</template>

<script>
import { defineComponent, ref, reactive } from 'vue';
import { getArticleInfo } from '@/api/article.js'
import router from '../../router'
import { useRoute} from 'vue-router'

export default defineComponent({
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