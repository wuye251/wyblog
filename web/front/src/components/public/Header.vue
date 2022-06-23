<template>
      <a-layout-header class="header">
        <a-menu
          v-model:selectedKeys="selectedKeys1"
          theme="lineHeight"
          mode="horizontal"
          :style="{ lineHeight: '64px' }"
          class="categoryList"
          :data-source="category" 
          @click="goToPage"
        >
            <a-menu-item :key="0">
                    首页
            </a-menu-item>
            <a-menu-item v-for="(item, index) in category" :key="item.ID">
                {{item.name}}
            </a-menu-item>

        </a-menu>
      </a-layout-header>

  </template>
<script>
import { defineComponent, ref, reactive } from 'vue';
import { getList } from '@/api/category.js'
import router from '../../router'

export default defineComponent({
    components: {

    },

    setup() {
        const category = ref([])
        return {
            selectedKeys1:ref([0]),
            category,
        };
    },
    created() {
        this.getCategoryList()
    },
    methods: {
        getCategoryList() { //顶部分类列表
            getList([]).then(res => {
                this.category.push(...res.data)
            })
        },
        goToPage(item){
            if(item.key == 0) {
                console.log("one")
                this.$router.push('/')
            } else {
                console.log("two")
                this.$router.push('/article?category=' +item.key)
            }
        }
    },

});
</script>



<style>
.container .ant-layout-header {
    height: 10%;
    /* width: 1440px; */
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

