import {leftListAnimation} from '../helpers/animations'

window.addEventListener('load', () => {
  if (!document.querySelector('.news-card')) {
    return false
  } else {
    leftListAnimation('.news-card')
  }
})
