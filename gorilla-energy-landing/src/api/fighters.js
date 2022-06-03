import apiClient from './index'

export default {
  index (params) {
    return apiClient.get('/fighters', { params })
  },
  show (id, params) {
    return apiClient.get(`/fighters/${id}`, { params })
  }
}
