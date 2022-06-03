import NProgress from 'nprogress'

const progressShowDelay = 100
let routeResolved = false

NProgress.configure({ showSpinner: false })

export default function (router) {
  router.beforeEach((to, from, next) => {
    routeResolved = false
    setTimeout(() => {
      if (!routeResolved) {
        NProgress.start()
      }
    }, progressShowDelay)
    return next()
  })

  router.afterEach(() => {
    routeResolved = true
    NProgress.done()
  })
}
