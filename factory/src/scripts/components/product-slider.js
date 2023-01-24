import Swiper, {Navigation, Thumbs, Pagination} from 'swiper'

window.addEventListener('load', () => {
  if (!document.querySelector('.product-slider .main-slider')) {
    return false
  } else {
    new Swiper('.product-slider .main-slider', {
      loop: true

    })
    new Swiper('.product-slider .thumb-slider', {
      loop: true,
      spaceBetween: 12,
      slidesPerView: 'auto',
      freeMode: true,
      watchSlidesProgress: true
    })
    new Swiper('.product-slider .main-modal-slider', {

    })
    new Swiper('.product-slider .thumb-modal-slider', {
      loop: true,
      spaceBetween: 10,
      slidesPerView: 'auto',
      freeMode: true,
      watchSlidesProgress: true
    })
  }
})
