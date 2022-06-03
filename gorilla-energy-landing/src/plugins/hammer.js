import Vue from 'vue'
import Hammer from 'hammerjs'
import UAParser from 'ua-parser-js'

const device = new UAParser().getDevice()

Vue.directive('tap', {
  bind (element, binding) {
    if (typeof binding.value !== 'function') {
      return false
    }

    if (['mobile', 'tablet'].includes(device.type)) {
      const hammer = new Hammer(element)

      hammer.on('tap', binding.value)
    } else {
      element.addEventListener('click', binding.value)
    }
  }
})

Vue.directive('tap-outside', {
  bind (element, binding) {
    if (typeof binding.value !== 'function') {
      return false
    }

    const body = document.querySelector('body')

    const listener = (e) => {
      if (element.contains(e.target) || element === e.target) {
        return false
      }

      return binding.value()
    }

    if (['mobile', 'tablet'].includes(device.type)) {
      const hammer = new Hammer(body)

      hammer.on('tap', listener)
    } else {
      body.addEventListener('click', listener)
    }
  }
})
