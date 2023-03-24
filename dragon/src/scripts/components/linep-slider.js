import Swiper, {Navigation, Pagination, Autoplay, EffectFade} from 'swiper'

window.addEventListener('load', () => {
  if (!document.querySelector('.main-lineup')) {
    return false
  } else {
    new Swiper('.main-lineup .swiper',  {
      modules: [Autoplay, Navigation, Pagination, EffectFade],
      loop: true,
      slidesPerView: 1,
      speed: 500,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true
      },
      effect: 'fade',
      fadeEffect: {
        crossFade: true
      }
    })
  }
})
