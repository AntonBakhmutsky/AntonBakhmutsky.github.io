import Swiper, {Navigation, Thumbs, Pagination} from 'swiper'

window.addEventListener('load', () => {
  if (!document.querySelector('.product-slider .main-slider')) {
    return false
  } else {
    const thumbSlider = new Swiper('.product-slider .swiper.thumb-slider', {
      spaceBetween: 12,
      slidesPerView: 'auto',
      freeMode: true,
      watchSlidesProgress: true
    })
    new Swiper('.product-slider .swiper.main-slider', {
      modules: [Navigation, Pagination, Thumbs],
      spaceBetween: 10,
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
        },
        1025: {
          slidesPerView: 1
        }
      }
    })
    const thumbModalSlider = new Swiper('.product-slider .swiper.thumb-modal-slider', {
      spaceBetween: 6,
      slidesPerView: 'auto',
      freeMode: true,
      watchSlidesProgress: true,
      breakpoints: {
        1025: {
          direction: 'vertical',
        }
      }
    })
    new Swiper('.product-slider .swiper.main-modal-slider', {
      modules: [Navigation, Pagination, Thumbs],
      loop: true,
      spaceBetween: 200,
      slidesPerView: 1,
      centeredSlides: true,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      thumbs: {
        swiper: thumbModalSlider,
      },
    })
  }
})
