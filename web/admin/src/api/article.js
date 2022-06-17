
import request from '@/utils/request'

export function login(data) {
  return request({
    url: '/api/v1/login',
    method: 'post',
    data:data
  })
}

export function articleList(data) {
  return request({
    url: '/api/v1/article/list',
    method: 'get',
    params:data
  })
}


export function addArticle(info) {
  return request({
    url: '/api/v1/article/add',
    method: 'post',
    data:info,
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

