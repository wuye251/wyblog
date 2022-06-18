<template>
  <router-view v-if="isRouterAlive"></router-view>
  <!-- 在router-view使用isRouterAlive或者是下面这种在组件中使用 -->
  <!-- <BLank v-if="isRouterAlive"></BLank> -->
</template>

<script>
import { ref, nextTick, provide } from "vue";
export default {
  name: "App",
  components: {
  },
  setup() {
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
      isRouterAlive,
    };
  },
};
</script>