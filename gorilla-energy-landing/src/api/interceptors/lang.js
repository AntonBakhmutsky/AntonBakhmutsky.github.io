import vm from '@/main'

export default function (apiClient) {
  apiClient.interceptors.request.use(config => {
    config.headers['Accept-Language'] = vm.$i18n.locale
    return config
  })
}
