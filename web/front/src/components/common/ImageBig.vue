<template>
  <div class="Big_image">
    <!-- 过渡动画 -->
    <transition name="fade">
      <div class="img-view" @click="bigImg">
        <!-- 遮罩层 -->
        <div class="img-layer"></div>
        <div class="img">
          <img :style="{width:imgWidth,height:imgHeight}" :src="imgSrc">
        </div>
      </div>
    </transition>
  </div>
</template>
​
<script>
export default {
  props: {
    imgSrc: {
      type: String,
      default: '',
      required: true,
    },
    imgWidth: {
      type: String,
      default: '',
    },
    imgHeight: {
      type: String,
      default: '',
    },
  },
  methods: {
    data() {
      return {};
    },
    bigImg() {
      // 发送事件
      this.$emit('clickit');
    },
  },
};
</script>
<style lang="scss" scoped>
.Big_image {
  .fade-enter-active,
  .fade-leave-active {
    transition: all 1s;
    transform:translate3d(0, 0, 0);
  }
  .fade-enter,
  .fade-leave-active {
    transform: translate3d(100%, 0, 0);
  }
  /* bigimg */
  .img-view {
    position: inherit;
    width: 100%;
    height: 100%;
  }
  .img-view .img-layer {
    position: fixed;
    z-index: 999;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.7);
    width: 100%;
    height: 100%;
    overflow: hidden;
  }
  .img-view .img {
    img {
      max-width: 100%;
      display: block;
      position: absolute;
      left: 50%;
      right: 50%;
      // margin: auto ;
      z-index: 1000;
      transform: translate(-50%, -50%);
    }
  }
}
</style>
​

作者：孤山渐青
链接：https://juejin.cn/post/7009220633720520717
来源：稀土掘金
著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。