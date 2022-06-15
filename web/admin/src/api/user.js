
import request from '@/utils/request'
// 修改头像
export function login(data) {
  return request({
    url: '/api/v1/login',
    method: 'post',
    data:data
  })
}