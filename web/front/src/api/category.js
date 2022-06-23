
import request from '@/api/request'

export function getList(data) {
  return request({
    url: '/api/v1/category/list',
    method: 'get',
    params:data
  })
}


