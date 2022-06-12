import axios from 'axios'
import './plugin/antui'

axios.defaults.baseURL = 'http://localhost:3000/api/v1'
this.$http = axios
