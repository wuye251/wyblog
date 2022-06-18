import { timelineItemProps } from 'ant-design-vue/es/timeline'
import Cookies from 'js-cookie'

const TokenKey = 'WYBLOG-TOKEN'
const LiveTime = 10*24*60*60

export function getToken() {
  return Cookies.get(TokenKey)
}

export function setToken(token) {
  return Cookies.set(TokenKey, token, {expires: LiveTime})
}

export function removeToken() {
  return Cookies.remove(TokenKey)
}