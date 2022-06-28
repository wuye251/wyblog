<template>
    <div class="container">
        <div class="loginBox">
        <a-form
        :model="formState"
        name="basic"
        :label-col="{ span: 8 }"
        autocomplete="off"
        @finish="onFinish"
        @finishFailed="onFinishFailed"
        class="loginForm">
            <a-form-item
            :rules="[{ required: true, message: 'Please input your username!' }]"
            >
                <a-input v-model:value="formState.username" type="username" placeholder="Username">
                   <template #prefix><UserOutlined style="color: rgba(0, 0, 0, 0.25)" /></template>
                </a-input>
            </a-form-item>

            <a-form-item
            :rules="[{ required: true, message: 'Please input your password!' }]"
            >
            <a-input v-model:value="formState.password" type="password" placeholder="Password">
                <template #prefix><LockOutlined style="color: rgba(0, 0, 0, 0.25)" /></template>
            </a-input>
            </a-form-item>

            <a-form-item name="remember" >
                <a-checkbox v-model:checked="formState.remember">Remember me</a-checkbox>
            </a-form-item>

            <!--<a-form-item :wrapper-col="{ offset: 16, span: 18 }" class="loginBtn">-->
            <a-form-item>
                <!--<a-button type="primary" html-type="submit" style="margin-right:8px;"
                :disabled="formState.user === '' || formState.password === ''"
                >-->
                <a-button type="primary" html-type="submit" class="login-form-button"
                :disabled="formState.user === '' || formState.password === ''"
                @click="loginSubmit"
                >
                    Log in
                </a-button>
            </a-form-item>
        </a-form>
        </div>

    </div>
</template>

<script>
// eslint-disable-next-line no-unused-vars
import { UserOutlined, LockOutlined } from '@ant-design/icons-vue'
import { defineComponent, reactive } from 'vue'
// import axios from 'axios'
import { login } from '@/api/user.js'
import { setToken } from '@/utils/auth'

export default defineComponent({
  components: {
    UserOutlined,
    LockOutlined
  },
  setup () {
    const formState = reactive({
      username: '',
      password: ''
    })

    const handleFinish = values => {
      console.log(values, formState)
    }

    const handleFinishFailed = errors => {
      console.log(errors)
    }

    return {
      formState,
      handleFinish,
      handleFinishFailed
    }
  },
  methods: {
    // 提交接口
    loginSubmit () {
      login(this.formState).then(res => {
          let data = res.data
          let code = res.code
          if(code=='1002') {
            console.log("密码错误")
            return this.$message.error(res.message)
          }
          if(code=='200'){
            console.log("登录成功")
            // window.sessionStorage.setItem('token', data)
            setToken(data)
            this.$message.success("登录成功")
            this.$router.push('/dashboard')
          }
        }).catch(err => {
          console.log('err')
          console.log(err)
          return this.$message.error(err)

        })
    }
  }
})
</script>

<style scoped>
.container {
    height: 100%;
    background-color: #232730;
}

.loginBox {
    width: 450px;
    height: 300px;
    background-color: #fff;
    position: absolute;
    top: 50%;
    left: 70%;
    transform: translate(-50%, -50%);
    border-radius: 9px;
}
.loginForm {
    width:100%;
    position:absolute;
    bottom:10%;
    padding:0 20px;
    box-sizing:border-box;
}
.loginBtn {
    display:flex;
    justify-content:flex-end;
}

.login-form {
  max-width: 300px;
}
.login-form-wrap {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.login-form-button {
  width: 100%;
}
</style>
