import axios from 'axios'

import interceptorsInit from './interceptors/init'

const apiClient = axios.create({
  baseURL: process.env.VUE_APP_API_BASE_URL,
  headers: {
    'Accept': 'application/json'
  }
})

interceptorsInit(apiClient, ['lang'])

export default apiClient
