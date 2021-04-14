import Vue from 'vue'
import Router from 'vue-router'

import routes from './routes'

import middlewaresInit from './middlewares/init'

Vue.use(Router)

const router = new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes,
  linkActiveClass: 'active',
  scrollBehavior: (to) => {
    if (to.hash) {
      return { selector: to.hash }
    } else {
      return { x: 0, y: 0 }
    }
  }
})

middlewaresInit(router, ['errors', 'progress'])

export default router
