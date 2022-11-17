import {topListAnimation} from '../helpers/animations'

window.addEventListener('load', () => {
  if (!document.querySelector('.why__list')) {
    return false
  } else {
    topListAnimation('.why__list li')
  }
})
