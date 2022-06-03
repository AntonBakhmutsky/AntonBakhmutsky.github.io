export default function (apiClient, interceptors = []) {
  interceptors.forEach((file) => {
    require(`./${file}`).default(apiClient)
  })
}
