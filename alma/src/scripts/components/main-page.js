import Swiper from 'swiper'
import { Navigation, Pagination } from 'swiper/modules'

window.addEventListener('load', () => {

  if (!document.querySelector('.main-slider')) {
    return false
  } else {
    new Swiper('.main-slider .swiper', {
      modules: [Navigation, Pagination],
      loop: true,
      pagination: {
        el: '.swiper-pagination',
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      }
    })
    new Swiper('.main-slider-mobile .swiper', {
      modules: [Navigation, Pagination],
      loop: true,
      slidesPerView: 1,
      spaceBetween: 20,
      pagination: {
        el: '.swiper-pagination',
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      }
    })
  }

})
