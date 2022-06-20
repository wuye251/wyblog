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
            <a-list  class="myArticleList" item-layout="horizontal" :data-source="data">
                <template #renderItem="{ item }">
                  <a-list-item>
                    <a-list-item-meta
                      description="到时候这就是博客的描述到时候这就是博客的描述到时候这就是博客的描述到时候这就是博客的描述到时候这就是博客的描述到时候这就是博客的描述到时候这就是博客的描述到时候这就是博客的描述到时候这就是博客的描述到时候这就是博客的描述到时候这就是博客的描述到时候这就是博客的描述
                      到时候这就是博客的描述到时候这就是博客的描述到时候这就是博客的描述到时候这就是博客的描述"
                    >
                      <template #title>
                        <a href="https://www.antdv.com/">{{ item.title }}</a>
                      </template>
                      <template #avatar>
                        <a-avatar src="https://joeschmoe.io/api/v1/random" />
                      </template>
                    </a-list-item-meta>
                  </a-list-item>
                </template>
              </a-list>
              <a-pagination @change="" class="myPagination" :showSizeChanger=false v-model:current="current" :total="500" show-less-items />
        </div>
        
    </a-layout-content>
</template>

<script>
import { defineComponent, ref } from 'vue';
const data = [{
    title: '这是第一篇文章标题这是第一篇文章标题',
    }, {
    title: '这是第一篇文章标题这是第一篇文章标题',
    }, {
    title: '这是第三篇文章标题',
        }, {
        title: '这是第四篇文章标题',
    },
    {
    title: '这是第四篇文章标题',
}
];
export default defineComponent({
    setup() {
        const pagination = {
            onChange: page => {
                console.log(page);
            },
            pageSize: 5,
        };

        return {
            pagination,
            data,
        };
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
    width: 40%;
    border-radius: 9px;
    margin: 0 auto;
}
.myArticleList {
    padding: 10px !important;
    background-color: #fffefe;
    box-shadow: inset 0 -3em 3em rgb(0 0 0 / 1%), 0 0 0 2px rgb(255 255 255), 0.3em 0.3em 1em rgb(0 0 0 / 20%);

}
.ant-list {
    margin: 0 auto !important;
}
.ant-list-item {
    /* min-height: 200px; */
}

.myPagination {
    padding: 30px 30px 10px 30px !important;
    max-width: 56%;
    margin: 0 auto !important;
}
</style>