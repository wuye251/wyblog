
import request from '@/api/request'

export function login(data) {
  return request({
    url: '/api/v1/login',
    method: 'post',
    data:data
  })
}

export function userList(data) {
  return request({
    url: '/api/v1/user/list',
    method: 'get',
    params:data
  })
}


export function getUserById(id,) {
  return request({
    url: '/api/v1/user/' + id,
    method: 'get',
    params:'',
  })
}

export function updateUserInfo(id, info) {
  return request({
    url: '/api/v1/user/' + id,
    method: 'put',
    data:info,
  })
}

export function deleteUserById(id) {
  return request({
    url: '/api/v1/user/' + id,
    method: 'delete',
    params:'',
  })
}

