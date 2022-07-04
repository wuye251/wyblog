
import request from '@/api/request'

export function articleList(data) {
  return request({
    url: '/api/v1/front/article/list',
    method: 'get',
    params:data
  })
}

export function categoryArticleList(id, data) {
  return request({
    url: '/api/v1/front/article/listByCategory/' + id,
    method: 'get',
    params:data
  })
}


export function getArticleInfo(id) {
  return request({
    url: '/api/v1/front/article/info/'+id,
    method: 'get',
  })
}
