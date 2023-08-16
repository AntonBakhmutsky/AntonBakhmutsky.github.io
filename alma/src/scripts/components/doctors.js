import Swiper from 'swiper'
import {Navigation} from 'swiper/modules'

window.addEventListener('load', () => {
  new Swiper('.doctors-slider .swiper', {
    modules: [Navigation],
    slidesPerView: 4,
    spaceBetween: 24,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    }
  })
})
