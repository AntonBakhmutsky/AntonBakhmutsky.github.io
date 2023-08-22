import Swiper from 'swiper'
import {Navigation} from 'swiper/modules'
import initModalImage from '@/scripts/helpers/modalImage'
import {Navigation, Pagination} from 'swiper/modules'

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
