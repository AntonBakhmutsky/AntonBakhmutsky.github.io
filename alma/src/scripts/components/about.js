import Swiper from 'swiper'
import {Navigation} from 'swiper/modules'

window.addEventListener('load', () => {
  new Swiper('.about-slider .swiper', {
    modules: [Navigation],
    loop: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    }
  })
})
