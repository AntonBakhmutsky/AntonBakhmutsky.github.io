import {leftListAnimation} from '../helpers/animations'

window.addEventListener('load', () => {
  if (!document.querySelector('.sales__item')) {
    return false
  } else {
    leftListAnimation('.sales__item')
  }
})
