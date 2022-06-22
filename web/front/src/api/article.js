
import request from '@/api/request'

export function articleList(data) {
  return request({
    url: '/api/v1/article/list',
    method: 'get',
    params:data
  })
}

export function getArticleInfo(id) {
  return request({
    url: '/api/v1/article/info/'+id,
    method: 'get',
  })
}

export function addArticle(info) {
  return request({
    url: '/api/v1/article/add',
    method: 'post',
    data:info,
  })
}

export function updateArticle(id, info) {
  return request({
    url: '/api/v1/article/' + id,
    method: 'put',
    data:info,
  })
}

export function deleteArticleById(id) {
  return request({
    url: '/api/v1/article/' + id,
    method: 'delete',
    params:'',
  })
}

