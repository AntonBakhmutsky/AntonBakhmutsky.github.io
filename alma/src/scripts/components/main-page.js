import Swiper from 'swiper'
import { Navigation, Pagination } from 'swiper/modules'
import initModalImage from "@/scripts/helpers/modalImage";

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
  }

})
