import apiClient from './index'

export default {
  index (params) {
    return apiClient.get('/rappers', { params })
  },
  show (id, params) {
    return apiClient.get(`/rappers/${id}`, { params })
  }
}
