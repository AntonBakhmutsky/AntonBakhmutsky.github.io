import initModalImage from '@/scripts/helpers/modalImage'
import Swiper from 'swiper'
import { Navigation } from 'swiper/modules'
window.addEventListener('load', () => {

  if (!document.querySelector('.doctor')) {
    return false
  } else {
    const docs = document.querySelectorAll('.docs-card')
    initModalImage(docs)
  }

  new Swiper('.doctor-slider .swiper', {
    modules: [Navigation],
    slidesPerView: 4,
    spaceBetween: 24,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    breakpoints: {
      320: {
        slidesPerView: 2.1,
        spaceBetween: 20
      },
      460: {
        slidesPerView: 3.2,
        spaceBetween: 20
      },
      700: {
        slidesPerView: 4,
        spaceBetween: 24
      }
    }
  })
})
