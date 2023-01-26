import {leftListAnimation} from '../helpers/animations'

window.addEventListener('load', () => {
  if (!document.querySelector('.index-news')) {
    return false
  } else {
    leftListAnimation('.news-card')
  }
})
