import Vue from 'vue'

import inViewport from '../helpers/inViewport'

Vue.directive('lazyload', {
  bind: (element) => {
    inViewport(element, () => {
      const src = element.dataset.src
      const backImg = element.dataset.back

      if (src) {
        element.setAttribute('src', src)
        element.removeAttribute('data-src')
      } else if (backImg) {
        element.style.backgroundImage = `url(${backImg})`
        element.removeAttribute('data-back')
      }

      element.dataset.lazyloaded = 'true'
    }, 'offset')
  }
})
