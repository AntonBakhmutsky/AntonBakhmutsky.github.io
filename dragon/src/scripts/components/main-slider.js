import Swiper, {Navigation, Pagination, Autoplay} from 'swiper'

window.addEventListener('load', () => {
  if (!document.querySelector('.main-slider')) {
    return false
  } else {
    new Swiper('.main-slider .swiper',  {
      modules: [Autoplay, Navigation, Pagination],
      loop: true,
      slidesPerView: 1,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
      },
    })
  }
})
