import { Button, Form, Input, Layout, message, Upload } from 'ant-design-vue/es'
import 'ant-design-vue/dist/antd.css'

const ant = {
  install (Vue) {
    Vue.component(Button.name, Button)
    Vue.component(Input.name, Input)
    Vue.component(Form.name, Form)
    Vue.component(Layout.name, Layout)
    Vue.component(message.name, message)
    Vue.component(Upload.name, Upload)

  }
}
export default ant


