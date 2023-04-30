<template>
    <a-layout-content>
        <!-- 左边 个人简介 -->
        <!-- <a-card class="resume" title="个人信息">
            <template #extra><a href="#">more</a></template>
            <p>性别：男</p>
            <p>颜值：帅</p>
            <p>评价：高富帅</p>
        </a-card> -->
        <div class="list-page">
            <div class="articleList">
                <li v-for="(item, index) in data">
                    <div class="li-list-main-content" @click="goToInfo(item.ID)">
                        <div class="list-main-content">
                            <div class="title">
                                <a @click="goToInfo(item.ID)">
                                    {{ item.title }}
                                </a>
                            </div>
                            <div class="desc">{{item.desc}}</div>
                            <div class="main-foot">
                                <div class="main-category">
                                    <profile-outlined :style="{fontSize: '20px', color: 'black'}"/> 
                                    <span style="font-size:15px; margin-top: -2px; margin-left:5px;">{{item.Category.name}}</span>
                                </div>
                                <div class="main-time" style="margin-left: 15px;">
                                    <field-time-outlined :style="{fontSize: '20px', color: 'black'}" /> 
                                    <span style="font-size:15px; margin-top: -2px; margin-left:5px;">{{getTime(item.UpdatedAt)}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </div>
            <a-pagination
            class="myPagination"
            v-model:current="pagination.defaultCurrent"
            v-model:page-size="pagination.defaultPageSize"
            :showSizeChanger=false
            :total="total"
            @change="onChange"
            />
        </div>
    </a-layout-content>
</template>

<script>
import { defineComponent, ref, reactive } from 'vue';
import router from '../../router'
import { articleList, categoryArticleList } from '@/api/article.js'
import { useRoute} from 'vue-router'
import day from 'dayjs'
import { 
    FieldTimeOutlined,
    ProfileOutlined,
} from '@ant-design/icons-vue';


export default defineComponent({
    components: {
        FieldTimeOutlined,
        ProfileOutlined,
    },
    data() {
        return {
            pagination:{
                defaultCurrent:1,
                defaultPageSize:6
            },
            data: [],
            total: 0,
            routeQuery: {},
        };
    },

    created() {
        this.getRouteQuery()
        this.getArtList()
        
        console.log("created")
    },
    methods: {
        onChange(current, size)  {  
            this.pagination.defaultCurrent = current  
            this.pagination.defaultPageSize = size  
            this.getArtList()  
        }, // 点击页码事件  
        goToInfo(id) {
            router.push({path: '/article/info',query: {id:id}})
        },
        getTime(val) {
            return val ? day(val).format('YYYY/MM/DD HH:mm') : '暂无'
        },
        getArticleList() {
            let params = {
                pageSize: this.pagination.defaultPageSize,
                pageNum: this.pagination.defaultCurrent,
            }
            articleList(params).then(res => {
                this.data = []
                this.data.push(...res.data)
                for (var i=0; i<this.data.length; i++) {
                    this.data[i].UpdatedTime =  day(this.data[i].UpdatedAt).format('YYYY/MM/DD HH:mm')
                }
                console.log(this.data)
                this.total = res.total
                console.log(this.pagination)
            })
            
        },
        getCategoryArticleList(id) {
            let params = {
                pageSize: this.pagination.defaultPageSize,
                pageNum: this.pagination.defaultCurrent
            }
            categoryArticleList(id, params).then(res => {
                this.data = []
                this.data.push(...res.data)
                this.total = res.total
            })
            
        },

        getRouteQuery() {
            let route = useRoute() // 第一步
            this.routeQuery = route.query // 第二步
        },

        getArtList() {
            if(this.routeQuery.category != undefined) {
                this.getCategoryArticleList(this.routeQuery.category)
            } else {
                this.getArticleList()
            }
            window.scrollTo(0,0);
        }
    },

});
</script>


<style>
.list-page {
    display: flex;
    min-height: 80vh;
    flex-direction: column;
    width: 800px;
    border-radius: 9px;
    margin: 0 auto;
    padding: 10px !important;
    background-color: #fffefe;
    box-shadow: inset 0 -3em 3em rgb(0 0 0 / 1%), 0 0 0 2px rgb(255 255 255), 0.3em 0.3em 1em rgb(0 0 0 / 20%);
    min-height: 80vh;
    position: relative;
}
.li-list-main-content:hover{
    background: #fafafa;
    cursor: pointer;
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
    width: 100%;
}
.articleList li{
    list-style: none;
}

.li-list-main-content{
    /* min-height: 200px; */
    display: flex;
    border-bottom: 1px solid rgba(228, 230, 235, 0.5);
}

.list-main-content {
    flex: 1;
    flex-direction: column;
    display: flex;
    margin: 3px 1px 1px 5px;

}
.main-foot { 
    display: flex;
    margin: 5px;
}
.main-category {
    display: flex;
}
.main-time {
    display: flex;
}
.main-category {
    display: flex;
}
.img {
    /* background-color: beige; */
    margin-top: 14px;
}
.img-info {
    height: 95%;
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
    text-align: center;
    padding: 10px !important;
    /*必须auto  列表不满一页 会自动固定到底部*/
    margin-top: auto !important;
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
    /* min-height: 63%; */
}
</style>