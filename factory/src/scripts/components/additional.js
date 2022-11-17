import Swiper, {Navigation} from 'swiper'
import {topListAnimation} from '../helpers/animations'

window.addEventListener('load', () => {
  if (!document.querySelector('.additional .swiper')) {
    return false
  } else {
    const slider = new Swiper('.additional .swiper', {
      modules: [Navigation],
      navigation: {
        nextEl: '.swiper-button-next'
      },
      loop: true,
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 10
        },
        390: {
          slidesPerView: 1.2,
          spaceBetween: 20
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 20
        },
        1024: {
          slidesPerView: 2.5,
          spaceBetween: 20
        }
      }
    })

    topListAnimation('.additional .swiper-slide:not(.swiper-slide-duplicate)')
  }
})
