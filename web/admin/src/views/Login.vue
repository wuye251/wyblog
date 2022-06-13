<template>
    <div class="container">
        <div class="loginBox">
            <a-form
                :model="formState"
                name="basic"
                :label-col="{ span: 8 }"
                :wrapper-col="{ span: 16 }"
                autocomplete="off"
                @finish="onFinish"
                @finishFailed="onFinishFailed"
            >
                <a-form-item
                label="Username"
                name="username"
                :rules="[{ required: true, message: 'Please input your username!' }]"
                >
                <a-input v-model:value="formState.username" />
                </a-form-item>

                <a-form-item
                label="Password"
                name="password"
                :rules="[{ required: true, message: 'Please input your password!' }]"
                >
                <a-input-password v-model:value="formState.password" />
                </a-form-item>

                <a-form-item name="remember" :wrapper-col="{ offset: 8, span: 16 }">
                <a-checkbox v-model:checked="formState.remember">Remember me</a-checkbox>
                </a-form-item>

                <a-form-item :wrapper-col="{ offset: 8, span: 16 }">
                <a-button type="primary" html-type="submit">Submit</a-button>
                </a-form-item>
            </a-form>
        </div>

        <!-- <a-button type="primary">登录</a-button> -->
    </div>
</template>

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
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 9px;
}
</style>

<script>
import { defineComponent, reactive } from 'vue';
export default defineComponent({
  setup() {
    const formState = reactive({
      username: '',
      password: '',
      remember: true,
    });

    const onFinish = values => {
      console.log('Success:', values);
    };

    const onFinishFailed = errorInfo => {
      console.log('Failed:', errorInfo);
    };

    return {
      formState,
      onFinish,
      onFinishFailed,
    };
  },

});
</script>