import {leftListAnimation} from '../helpers/animations'

window.addEventListener('load', () => {
  if (!document.querySelector('.partners__list')) {
    return false
  } else {
    leftListAnimation('.partners__list li')
  }
})
