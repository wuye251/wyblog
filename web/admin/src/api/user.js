
import request from '@/utils/request'

export function login(data) {
  return request({
    url: '/api/v1/login',
    method: 'post',
    data:data
  })
}

export function userList(data) {
  return request({
    url: '/api/v1/list',
    method: 'get',
    data:data
  })
}