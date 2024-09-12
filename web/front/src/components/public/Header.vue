<template>
  <a-layout-header class="header">
    <a-menu
      v-model:selectedKeys="selectedKeys1"
      mode="horizontal"
      :style="{ lineHeight: '64px' }"
      class="categoryList"
    >
      <a-menu-item :key="0" @click="goToPage(0)">
        首页
      </a-menu-item>

      <a-sub-menu v-for="(item, index) in category" >
        <template #title>
          <a-menu-item :key="item.ID" @click.stop="goToPage(item.ID)">{{ item.name }}</a-menu-item>
        </template>
        <a-menu-item v-for="(subItem, subIndex) in item.sub_categories" :key="subItem.ID" @click="goToPage(subItem.ID)">
          {{ subItem.name }}
        </a-menu-item>
      </a-sub-menu>
      <!-- <a-menu-item key="websiteHistory">网站历程</a-menu-item> -->
      <!-- <a-menu-item key="github">
        <template #icon><github-outlined /></template>
        <a href="https://github.com/wuye251" target="_blank" rel="noopener noreferrer">
          Github
        </a>
      </a-menu-item> -->
    </a-menu>
  </a-layout-header>
</template>

<script>
import { defineComponent, ref, watch } from 'vue';
import { GithubOutlined } from '@ant-design/icons-vue';
import { getList } from '@/api/category.js';
import router from '../../router';

export default defineComponent({
  components: {
    GithubOutlined,
  },
  setup() {
    const category = ref([]);
    const selectedKeys1 = ref([0]);

    // 获取分类列表
    const getCategoryList = () => {
      getList([]).then((res) => {
        category.value = res.data;
      });
    };

    // 页面跳转
    const goToPage = (id) => {
      selectedKeys1.value = [id.toString()];
      if (id === 0) {
        router.push('/');
      } else if (id === 'websiteHistory') {
        // TODO:网站历程跳转
        router.push('/');
      } else {
        router.push(`/article?category=${id}`);
      }
    };

    return {
      category,
      selectedKeys1,
      getCategoryList,
      goToPage,
    };
  },
  created() {
    this.getCategoryList();
  },
  watch: {
    // 监听路由变化，更新 selectedKeys
    '$route.query.category'(newCategory) {
      if (newCategory) {
        this.selectedKeys1 = [newCategory.toString()];
      } else {
        this.selectedKeys1 = ['0']; // 默认选中首页
      }
    }
  },
});
</script>

<style>
.container .ant-layout-header {
  height: 10%;
}
.categoryList {
  margin-left: 50px;
}
.category {
  margin: 15px;
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
