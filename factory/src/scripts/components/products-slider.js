import {topListAnimation} from '../helpers/animations'

window.addEventListener('load', () => {
  if (!document.querySelector('.products-tile')) {
    return false
  } else {
    // products list
    topListAnimation('.products-tile .product-card')
  }
})
