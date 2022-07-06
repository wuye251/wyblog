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
            pageSize: 5,
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
    width: 800px;
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
.content-main {
    /*有左侧简介时样式*/
    /* left: 71px;
    width: 500px;
    padding: 0 30px 30px 30px;
    background-color: #f9f9f9; */
    width: 40%;
    border-radius: 9px;
    margin: 0 auto;
    padding: 10px !important;
    background-color: #fffefe;
    box-shadow: inset 0 -3em 3em rgb(0 0 0 / 1%), 0 0 0 2px rgb(255 255 255), 0.3em 0.3em 1em rgb(0 0 0 / 20%);
    min-height:80vh;
    width:100%;
    position: relative;
}


</style>