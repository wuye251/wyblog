<template>
    <a-layout-content class="content">
        <!-- 左边 个人简介 -->
        <!-- <a-card class="resume" title="个人信息">
            <template #extra><a href="#">more</a></template>
            <p>性别：男</p>
            <p>颜值：帅</p>
            <p>评价：高富帅</p>
        </a-card> -->
        <div class="articleList">
            <li v-for="(item, index) in data" style="border-style: dashed;">
                    <div v-if="item.img" class="img">
                        <img class="img-info" :src="item.img">
                    </div>
                    
                    <div class="main-content">
                        <div class="main-header">
                            <div class="title">
                                <router-link :to="{ path: '/article/info', query: { id: `${item.ID}` }}">
                                    {{ item.title }}
                                </router-link> 
                            </div>
                            <div class="main-category">{{item.Category.name}}</div>
                            <div class="time" style="margin-left: 5px;">{{getTime(item.UpdatedAt)}}</div>
                        </div>
                        <div class="desc">{{item.desc}}</div>
    
                    </div>
            </li>
        </div>
        <a-pagination @change="" class="myPagination" :showSizeChanger=false v-model:current="current" :total="total" show-less-items />
        
    </a-layout-content>
</template>

<script>
import { defineComponent, ref, reactive } from 'vue';
import router from '../../router'
import { articleList, categoryArticleList } from '@/api/article.js'
import { useRoute} from 'vue-router'
import day from 'dayjs'

// const data = [{
//     title: '这是第一篇文章标题这是第一篇文章标题',
//     }, {
//     title: '这是第一篇文章标题这是第一篇文章标题',
//     }, {
//     title: '这是第三篇文章标题',
//         }, {
//         title: '这是第四篇文章标题',
//     },
//     {
//     title: '这是第四篇文章标题',
// }
// ];
export default defineComponent({
    setup() {
        const pagination = {
            onChange: page => {
                console.log(page);
            },
            pageSize: 5,
            pageNum: reactive(1)
        };

        return {
            pagination,
            data: ref([]),
            total:ref(0)
        };
    },
    created() {
        this.getArtList()
        console.log("created")
    },
    methods: {
        getTime(val) {
            return val ? day(val).format('YYYY/MM/DD HH:mm') : '暂无'
        },
        getArticleList() {
            let params = {
                pageSize: this.pagination.pageSize,
                pageNum: this.pagination.pageNum
            }
            articleList(params).then(res => {
                this.data.push(...res.data)
                for (var i=0; i<this.data.length; i++) {
                    this.data[i].UpdatedTime =  day(this.data[i].UpdatedAt).format('YYYY/MM/DD HH:mm')
                }
                console.log(this.data)
            })
            
        },
        getCategoryArticleList(id) {
            let params = {
                pageSize: this.pagination.pageSize,
                pageNum: this.pagination.pageNum
            }
            categoryArticleList(id, params).then(res => {
                this.data.push(...res.data)
                this.total = res.total
            })
            
        },

        getRouteQuery() {
            let route = useRoute() // 第一步
            let routeQuery = route.query // 第二步
            return routeQuery
        },

        getArtList() {
            let query = this.getRouteQuery()
            if(query.category != undefined) {
                console.log(1111)
                this.getCategoryArticleList(query.category)
            } else {
                console.log(222)
                this.getArticleList()
            }
        }
    },

});
</script>


<style>
.content {
    margin-top: 30px;
    min-height: 800px !important;
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
.articleList {
    /*有左侧简介时样式*/
    /* left: 71px;
    width: 500px;
    padding: 0 30px 30px 30px;
    background-color: #f9f9f9; */
    /* width: 40%; */
    border-radius: 9px;
    margin: 0 auto;
}
.articleList li{
    list-style: none;
    height: 210px;
    display: flex;
}

.main-content {
    flex: 1;
    flex-direction: column;
    display: flex;
    margin: 10px;

}
.main-header { 
    display: flex;
    margin: 5px;
}
.img {
    background-color: beige;
}
.img-info {
    height: 100%;
    width: 230px;
}
.ant-list {
    margin: 0 auto !important;
}
.ant-list-item {
    /* min-height: 200px; */
}

.myPagination {
    /* padding: 30px 30px 10px 30px !important;
    max-width: 40%;
    margin: 0 auto !important; */
    margin: 50px auto 0 auto !important;
    justify-content: center;
    text-align: center;
    position: absolute;
    left: 50%;
    bottom:0;
    transform: translate(-50%,-50%);
}

.title a:hover {
    text-decoration: underline;
    color: black;
}
.title a {
    color: black;
}
.title {
    display: inherit;
    font-size: 18px;
    font-weight: 700;
    line-height: 1.5;
}
.desc {
    margin: 0 0 8px;
    font-size: 13px;
    line-height: 24px;
    color: #999;
}
</style>