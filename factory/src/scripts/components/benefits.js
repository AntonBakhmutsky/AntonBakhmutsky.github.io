import Swiper, {Navigation, Pagination, Autoplay} from 'swiper'

window.addEventListener('load', () => {
  new Swiper('.benefits .swiper', {
    modules: [Navigation, Pagination],
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    },
    loop: true,
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets'
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 20
      },
      1025: {
        slidesPerView: 1.2,
        spaceBetween: 40,
        setWrapperSize: 804
      },
      1280: {
        slidesPerView: 1.6,
        spaceBetween: 40,
        setWrapperSize: 804
      }
    }
  })
})
