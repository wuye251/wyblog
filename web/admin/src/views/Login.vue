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
                <a-input v-model:value="formState.user" type="username" placeholder="Username">
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
                :disabled="formState.user === '' || formState.password === ''">
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
export default defineComponent({
  components: {
    UserOutlined,
    LockOutlined
  },
  setup () {
    const formState = reactive({
      user: '',
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
