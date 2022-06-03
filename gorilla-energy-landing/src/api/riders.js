import apiClient from './index'

export default {
  index (params) {
    return apiClient.get('/riders', { params })
  },
  show (id, params) {
    return apiClient.get(`/riders/${id}`, { params })
  }
}
