import axios from 'axios'
import { getToken } from '@/api/auth'

// 创建一个axios实例
const service = axios.create({
  // baseURL:window.g.BASE_URL, // api 的 base_url
  baseURL:'http://localhost:3000',
  // transformRequest: [function (data) {
  //   return qs.stringify(data)
  // }],
  headers: {
    'Content-Type': 'application/json'
  },
  timeout: 60000 // 请求超时
})

// 请求拦截器
// service.interceptors.request.use(
//   config => {
//     if (getToken()) {
//       // 让每个请求携带token-- ['X-Litemall-Admin-Token']为自定义key 请根据实际情况自行修改
//       config.headers['Authorization'] = `Bearea-Token ${getToken()}`
//     }
//     return config
//   },
//   error => {
//     console.log(error) // for debug
//     Promise.reject(error)
//   }
// )
let message = ''
// 响应拦截器
service.interceptors.response.use(
  response => {
    const res = response.data
    if (res.code === 0 || res.code === '0') {
        // 可以在这里统一处理响应错误
        message && message.close()
        message = Message({
          type: 'error',
          message: res.message == null?'请求异常':res.message
        });
        return Promise.reject(res);
    }else if(res.code === 100 || res.code === '100'){
      return Promise.reject(res);
    }else{
      // console.log('getApiResponse:',response.data)
      return response.data;
    }
  }, error => {
    console.error('请求失败' + error)//debug
    message && message.close()
    // 断网 或者 请求超时 状态
    if (!error.response) {
      // 请求超时状态
      if (error.message.includes('timeout')) {
        console.log('超时了')
        message = Message.error('请求超时，请检查网络是否连接正常')
      } else {
        // 可以展示断网组件
        console.log('断网了')
        message = Message.error('请求失败，请检查网络是否已连接')
      }
      return
    }
    return Promise.reject(error)
  })

export default service
