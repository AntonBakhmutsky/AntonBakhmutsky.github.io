import Swiper, {Navigation} from 'swiper'

window.addEventListener('load', () => {
  if (!document.querySelector('.about-slider .swiper')) {
    return false
  } else {
    if (window.innerWidth > 767) {
      new Swiper('.about-slider .swiper', {
        modules: [Navigation],
        cssMode: true,
        slidesPerView: 'auto',
        spaceBetween: 20,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        }
      })
    }
  }
})
