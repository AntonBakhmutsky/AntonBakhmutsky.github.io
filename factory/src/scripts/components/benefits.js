import Swiper, {Navigation, Pagination, Autoplay} from 'swiper'

window.addEventListener('load', () => {
  const slider = new Swiper('.benefits .swiper', {
    modules: [Navigation, Pagination, Autoplay],
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    },
    // autoplay: true,
    speed: 800,
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
