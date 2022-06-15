<template>
  <a-layout class="container">
    <Nav></Nav>
    
    <a-layout>
      <a-layout-header class="headerBtn">
      <Header></Header>
      </a-layout-header>
    
      <a-layout-content>
        <router-view></router-view>
      </a-layout-content>
    
      <a-layout-footer>
        <Footer></Footer>
      </a-layout-footer>
    
    </a-layout>

  </a-layout>
</template>

<script>
import { defineComponent, reactive } from 'vue'
import Header from '../components/admin/Header'
import Nav   from '../components/admin/Nav'
import Footer from '../components/admin/Footer'
import { removeToken } from '@/utils/auth'


export default defineComponent({
    components: {
        Header,
        Nav,
        Footer
    }

})
</script>

<style>
.container {
    height:100%;
}

.headerBtn {
    display:flex;
    justify-content:flex-end;
    align-items:center;
}
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