<template>
  <div class="container">
    <a-layout>
      <!-- 头部栅格 -->
      <Header></Header>
  
      <!-- 中间内容 -->
      <Content></Content>
  
      <!-- 底部声明 -->
      <Footer></Footer>
    </a-layout>  
  </div>
</template>

<script>
import { defineComponent, ref, reactive, nextTick, provide } from 'vue'
import Header from './components/public/Header'
import Nav   from './components/public/Nav'
import Footer from './components/public/Footer'
import Content from './components/public/Content'


export default defineComponent({
  name: "App",
  components: {
      Header,
      Nav,
      Footer,
      Content,
  },
})
</script>

<style>
.container {
  height:100%;
}
.container .ant-layout-header {
  height: 10%;
}
.content {
  height: 10%;
}
.footer {
  height: 10%;
}
</style>