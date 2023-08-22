import Swiper from 'swiper'
import {Navigation} from 'swiper/modules'
import initModalImage from '@/scripts/helpers/modalImage'

window.addEventListener('load', () => {
  if (!document.querySelector('.about-slider')) {
    return false
  } else  {
    new Swiper('.about-slider .swiper', {
      modules: [Navigation],
      loop: true,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      }
    })

    const slides = document.querySelectorAll('.about-slider .swiper-slide')
    initModalImage(slides)
  }
})
