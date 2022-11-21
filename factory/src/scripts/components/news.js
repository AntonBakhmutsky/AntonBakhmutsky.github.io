import Swiper, {Navigation} from 'swiper'

window.addEventListener('load', () => {
  if (!document.querySelector('.news-content .swiper')) {
    return false
  } else {
    const slider = new Swiper('.news-content .swiper', {
      modules: [Navigation],
      navigation: {
        nextEl: '.swiper-button-next'
      },
      loop: true,
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 10
        }
      }
    })
  }
})
