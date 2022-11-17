import {leftListAnimation} from '../helpers/animations'

window.addEventListener('load', () => {
  if (!document.querySelector('.index-news')) {
    return false
  } else {
    leftListAnimation('.index-news__item')
  }
})
