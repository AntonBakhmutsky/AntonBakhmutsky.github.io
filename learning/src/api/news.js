import apiClient from './index'

export default {
  index (params) {
    return apiClient.get('/news', { params })
  },
  show (id, params) {
    return apiClient.get(`/news/${id}`, { params })
  },
  categories (params) {
    return apiClient.get('/news/categories', { params })
  }
}
