import apiClient from './index'

export default {
  send (formData) {
    return apiClient.post('/feedback', formData)
  }
}
