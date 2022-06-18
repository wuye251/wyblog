<template>
    <a-layout-content class="content">
        <!-- 左边 个人简介 -->
        <!-- <a-card class="resume" title="个人信息">
            <template #extra><a href="#">more</a></template>
            <p>性别：男</p>
            <p>颜值：帅</p>
            <p>评价：高富帅</p>
        </a-card> -->
        <a-list  class="myArticleList" item-layout="horizontal" :data-source="data">
            <template #renderItem="{ item }">
              <a-list-item>
                <a-list-item-meta
                  description="到时候这就是博客的描述"
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
    </a-layout-content>
</template>

<script>
import { defineComponent } from 'vue';
const data = [{
    title: '这是第一篇文章标题',
    }, {
    title: '这是第二篇文章标题',
    }, {
    title: '这是第三篇文章标题',
    }, {
    title: '这是第四篇文章标题',
}];
export default defineComponent({
    setup() {
    return {
        data,
    };
    },

});
</script>


<style>
.resume {
    position:absolute; 
    left:100px; 
    width:200px; 
    background-color:#CCCCCC;
}
.myArticleList {
    width: 40%;
}
.ant-list {
    margin: 0 auto !important;
    min-height: 500px;
}
.ant-list-item {
    min-height: 200px;
}
</style>