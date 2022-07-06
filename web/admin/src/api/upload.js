
import request from '@/utils/request'

export function upload(info) {
  return request({
    url: '/api/v1/upload',
    method: 'post',
    data:{file:info},
    headers: { "Content-Type": "multipart/form-data" },
  })
}