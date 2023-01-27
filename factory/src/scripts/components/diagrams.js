import {leftListAnimation} from '../helpers/animations'

window.addEventListener('load', () => {
  if (!document.querySelector('.product-diagrams')) {
    return false
  } else {
    leftListAnimation('.product-diagrams__item')
  }
})
