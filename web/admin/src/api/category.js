
import request from '@/utils/request'

export function getList(data) {
  return request({
    url: '/api/v1/category/list',
    method: 'get',
    params:data
  })
}

export function add(name) {
  return request({
    url: '/api/v1/category/add',
    method: 'post',
    data:{name:name},
  })
}

export function getCategoryById(id,) {
  return request({
    url: '/api/v1/category/' + id,
    method: 'get',
    params:'',
  })
}

export function updateCategoryInfo(id, info) {
  return request({
    url: '/api/v1/category/' + id,
    method: 'put',
    data:info,
  })
}

export function deletecategoryById(id) {
  return request({
    url: '/api/v1/category/' + id,
    method: 'delete',
    params:'',
  })
}

