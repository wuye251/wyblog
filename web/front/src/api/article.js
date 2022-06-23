
import request from '@/api/request'

export function articleList(data) {
  return request({
    url: '/api/v1/article/list',
    method: 'get',
    params:data
  })
}

export function categoryArticleList(id, data) {
  return request({
    url: '/api/v1/article/listByCategory/' + id,
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
