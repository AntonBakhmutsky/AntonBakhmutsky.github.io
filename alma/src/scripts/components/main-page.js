import Swiper from 'swiper'
import { Navigation, Pagination } from 'swiper/modules'

window.addEventListener('load', () => {
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
})
