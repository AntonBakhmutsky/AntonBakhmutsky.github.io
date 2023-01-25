import {topListAnimation} from '../helpers/animations'

window.addEventListener('load', () => {
  if (!document.querySelector('.product-tile')) {
    return false
  } else {
    topListAnimation('.product-tile__item')
  }
})
