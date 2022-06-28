<template>
    <a-layout-sider breakpoint="lg">
        <div class="logo">
            <span>MyBlog Logo</span>
        </div>

        <a-menu
        v-model:openKeys="openKeys"
        mode="inline"
        theme="dark"
        :inline-collapsed="collapsed"
        @click="goToPage"
        >
            <a-menu-item key="dashboard">
                <pie-chart-outlined />
                <span>仪表盘</span>
            </a-menu-item>
            <a-sub-menu key="article">
                <template #title>
                    <span>
                    <snippets-outlined /><span>文章管理</span>
                    </span>
                </template>
                <a-menu-item key="add-article">
                    <edit-outlined />
                    <span>写文章</span>
                </a-menu-item>
                <a-menu-item key="article-list">
                    <menu-outlined />
                    <span>文章列表</span>
                </a-menu-item>
            </a-sub-menu>

            <a-menu-item key="category-list">
                <profile-outlined />
                <span>分类列表</span>
            </a-menu-item>

            <a-menu-item key="user-list">
                <team-outlined />
                <span>用户列表</span>
            </a-menu-item>

        </a-menu>
    </a-layout-sider>
</template>

<script>
import { 
    PieChartOutlined,
    SnippetsOutlined,
    EditOutlined,MenuOutlined,
    ProfileOutlined,
    TeamOutlined,
} from '@ant-design/icons-vue';
import { defineComponent, ref } from 'vue';

export default defineComponent({
  components: {
    PieChartOutlined,
    SnippetsOutlined,
    EditOutlined,
    MenuOutlined,
    ProfileOutlined,
    TeamOutlined,
  },

  data() {
    return {
      collapsed: ref(false),
      selectedKeys: ref(['1']),
    };
  },
  methods: {
    goToPage(item){
        this.$router.push('/' +item.key)
    }
  },

});

</script>

<style>
.logo {
    height:32px;
    margin:16px;
    background-color:#fff;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:17px;
}
</style>