// import Vue from 'vue'
import { Button, Form, Input } from 'ant-design-vue'

const ant = {
  install (Vue) {
    Vue.component(Button.name, Button)
    Vue.component(Input.name, Input)
    Vue.component(Form.name, Form)
  }
}
export default ant
