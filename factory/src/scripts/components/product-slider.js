import Swiper, {Navigation, Thumbs, Pagination} from 'swiper'

window.addEventListener('load', () => {
  if (!document.querySelector('.product-slider .main-slider')) {
    return false
  } else {
    new Swiper('.product-slider .main-slider', {
      loop: true

    })
    new Swiper('.product-slider .thumb-slider', {

    })
    new Swiper('.product-slider .main-modal-slider', {

    })
    new Swiper('.product-slider .thumb-modal-slider', {

    })
  }
})
