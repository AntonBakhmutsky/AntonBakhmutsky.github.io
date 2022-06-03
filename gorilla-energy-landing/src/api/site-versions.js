import apiClient from './index'

export default {
  index (params) {
    return apiClient.get('/site-versions', { params })
  },
  show (id, params) {
    return apiClient.get(`/site-versions/${id}`, { params })
  }
}
