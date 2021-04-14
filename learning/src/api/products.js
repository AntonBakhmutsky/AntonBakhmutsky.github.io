import apiClient from './index'

export default {
  index (params) {
    return apiClient.get('/products', { params })
  }
}
