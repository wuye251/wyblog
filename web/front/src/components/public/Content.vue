<template>
    <a-layout-content class="content">
        <!-- 左边 个人简介 -->
        <!-- <a-card class="resume" title="个人信息">
            <template #extra><a href="#">more</a></template>
            <p>性别：男</p>
            <p>颜值：帅</p>
            <p>评价：高富帅</p>
        </a-card> -->
        <div class="content-main">
            <router-view :key="$route.fullPath"></router-view>
        </div>
        
    </a-layout-content>
</template>

<script>
import { defineComponent, ref, reactive, nextTick, provide } from 'vue';
import { articleList } from '@/api/article.js'
import router from '../../router'

export default defineComponent({
    setup() {
        const pagination = {
            onChange: page => {
                console.log(page);
            },
            pageSize: 20,
            pageNum: reactive(1)
        };
        // 局部组件刷新
        const isRouterAlive = ref(true);
        const reload = () => {
            isRouterAlive.value = false;
            nextTick(() => {
            isRouterAlive.value = true;
            });
        };
        provide("reload", reload);

        return {
            pagination,
            data: ref([]),
            total:ref(0),
            isRouterAlive,
        };
    },
    created() {
        this.getArticleList()
    },
    methods: {
        getArticleList() {
            let params = {
                pageSize: this.pagination.pageSize,
                pageNum: this.pagination.pageNum
            }
            console.log(params)
            articleList(params).then(res => {
                
                this.data.push(...res.data)
                this.total = res.total
            })
        }
    },

});
</script>


<style>
.content {
    margin: auto;
    margin-top: 30px;
}
.resume {
    position:absolute; 
    left:100px; 
    float: left;
    width:200px; 
    background-color:#CCCCCC;
    left: 200px;
    width: 300px;
}



</style>