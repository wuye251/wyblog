<template>
        <a-button type="danger" @click="logout"> 退出</a-button>
</template>

<script>
import { removeToken } from '@/utils/auth'

export default {
    methods: {
        logout() {
            console.log('logout event')
            removeToken()
            this.$router.push('/login')
        }
    }
}
</script>