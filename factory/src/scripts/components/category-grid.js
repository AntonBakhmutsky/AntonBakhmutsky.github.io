import {topListAnimation} from '../helpers/animations'

window.addEventListener('load', () => {
  if (!document.querySelector('.category-grid')) {
    return false
  } else {
    topListAnimation('.category-grid__item')
  }
})
