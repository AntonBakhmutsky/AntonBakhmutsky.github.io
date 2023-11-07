import Swiper from 'swiper'
import {Autoplay, Pagination, Navigation} from 'swiper/modules'

window.addEventListener('load', () => {
  const swiper = new Swiper('.swiper',  {
    modules: [Autoplay, Pagination, Navigation],
    autoplay: true,
    loop: true,
    spaceBetween: 20,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
    },
  })

})
