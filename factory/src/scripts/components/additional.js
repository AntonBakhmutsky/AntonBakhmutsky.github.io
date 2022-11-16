import Swiper, {Navigation} from 'swiper'

window.addEventListener('load', () => {
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
})
