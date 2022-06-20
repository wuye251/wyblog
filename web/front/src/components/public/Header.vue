<template>
      <a-layout-header class="header">
        <a-menu
          v-model:selectedKeys="selectedKeys1"
          theme="lineHeight"
          mode="horizontal"
          :style="{ lineHeight: '64px' }"
          class="categoryList"
        >
        
            <a-menu-item key="1" class="category">博客</a-menu-item>
            <a-menu-item key="2">About</a-menu-item>

        </a-menu>
      </a-layout-header>

  </template>
<script>
import { defineComponent, ref } from 'vue';
export default defineComponent({
    components: {

    },

    setup() {
        return {
            selectedKeys1: ref(['1']),
        };
    },

});
</script>

<style>


<style>
.container .ant-layout-header {
    height: 10%;
    width: 1440px;
}
.categoryList {
    margin-left:50px;
}
.category {
    margin:15px;
}   

.header .ant-menu-dark.ant-menu-horizontal {
    border-bottom: 0;
    left: 15%;
    position: relative;
    margin-right: 20%;
}

.ant-layout-header {
    background: #fff !important;
    padding: 0 200px !important;
}
</style>

