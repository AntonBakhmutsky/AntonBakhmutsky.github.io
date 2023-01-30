import Swiper, {Navigation, Pagination} from 'swiper'
import {leftListAnimation} from '../helpers/animations'


window.addEventListener('load', () => {
  if (!document.querySelector('.production-slider')) {
    return false
  } else {
    new Swiper('.production-slider .swiper', {
      modules: [Navigation, Pagination],
      loop: true,
      loopAdditionalSlides: 9,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true
      },
      breakpoints: {
        320: {
          slidesPerView: 1.06,
          spaceBetween: 10
        },
        1025: {
          slidesPerView: 1,
          spaceBetween: 0
        }
      }
    })
    leftListAnimation('.production-aside__item')
  }
})
