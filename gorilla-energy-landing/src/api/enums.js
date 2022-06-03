import apiClient from './index'

export default {
  index () {
    return apiClient.get('/enums')
  }
}
