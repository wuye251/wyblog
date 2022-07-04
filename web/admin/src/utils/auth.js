import { timelineItemProps } from 'ant-design-vue/es/timeline'
import Cookies from 'js-cookie'

const TokenKey = 'WYBLOG-TOKEN'
let hour = 10 //失效时间是几小时


export function getToken() {
  return Cookies.get(TokenKey)
}

export function setToken(token) {
  let expires= new Date(new Date().getTime() + hour * 60 * 60 * 1000);
  return Cookies.set(TokenKey, token, {expires: expires})
}

export function removeToken() {
  return Cookies.remove(TokenKey)
}


