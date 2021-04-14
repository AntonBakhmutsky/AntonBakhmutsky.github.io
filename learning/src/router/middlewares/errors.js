export default function (router) {
  router.onError(() => {
    router.push({ name: '404' })
  })
}
