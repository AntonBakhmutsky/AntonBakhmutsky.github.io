import Swiper, {Navigation} from 'swiper'
import {topListAnimation} from '../helpers/animations'

window.addEventListener('load', () => {
  if (!document.querySelector('.product-slider .swiper')) {
    return false
  } else {
    const slider = new Swiper('.product-slider .swiper', {
      modules: [Navigation],
      navigation: {
        nextEl: '.swiper-button-next'
      },
      loop: true,
      breakpoints: {
        320: {
          slidesPerView: 1,
        },
        640: {
          slidesPerView: 1.2,
          spaceBetween: 20
        },
        768: {
          slidesPerView: 1.4,
          spaceBetween: 20
        },
        1280: {
          slidesPerView: 2.3,
          spaceBetween: 20
        }
      }
    })

    // products list
    topListAnimation('.product-slider .swiper-slide:not(.swiper-slide-duplicate)')

    // swiper wrapper height
    const swiperSlideImgs = document.querySelectorAll('.product-slider .swiper-slide .swiper-slide-image');
    const swiperWrapper = document.querySelector('.product-slider .swiper-wrapper')

    function setSwiperHeight() {
      const contentHeights = [];

      swiperSlideImgs.forEach(el => contentHeights.push(el.scrollHeight));

      const maxContentHeight = Math.max(...contentHeights);

      swiperWrapper.style.height = `${maxContentHeight}px`
    }

    setSwiperHeight()

    window.addEventListener('resize', () => {
      swiperWrapper.style.height = 'auto'
      setSwiperHeight()
    })

  }
})
