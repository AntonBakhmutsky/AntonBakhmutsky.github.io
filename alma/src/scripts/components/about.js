import Swiper from 'swiper'
import {Navigation, Pagination} from 'swiper/modules'

window.addEventListener('load', () => {
  new Swiper('.about-slider .swiper', {
    modules: [Navigation],
    loop: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    }
  })

  new Swiper('.about-slider-mobile .swiper', {
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
})
