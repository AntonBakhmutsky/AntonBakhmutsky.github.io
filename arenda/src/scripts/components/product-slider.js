import Swiper, {Navigation, Thumbs, Pagination} from 'swiper'

window.addEventListener('load', () => {
  if (document.querySelector('.product-slider .main-slider')) {
    const thumbSlider = new Swiper('.product-slider .swiper.thumb-slider', {
      spaceBetween: 17,
      slidesPerView: 5,
      watchSlidesProgress: true
    })
    new Swiper('.product-slider .swiper.main-slider', {
      modules: [Navigation, Pagination, Thumbs],
      spaceBetween: 8,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true
      },
      thumbs: {
        swiper: thumbSlider,
      },
      breakpoints: {
        320: {
          slidesPerView: 1.06,
          loop: false
        },
        1025: {
          slidesPerView: 1,
          loop: true
        }
      }
    })
  }
})
