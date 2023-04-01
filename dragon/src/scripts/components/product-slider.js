import Swiper, {Navigation, Thumbs, Pagination} from 'swiper'

window.addEventListener('load', () => {
  if (!document.querySelector('.product-top__slider')) {
    return false
  } else {
    const thumbSlider = new Swiper('.product-top__slider .swiper.swiper_thumb', {
      modules: [Navigation],
      slidesPerView: 5,
      freeMode: true,
      watchSlidesProgress: true,
      direction: 'vertical',
      slidesPerGroup: 5,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        1025: {
          spaceBetween: 12
        },
        1521: {
          spaceBetween: 20
        }
      }
    })
    new Swiper('.product-top__slider .swiper.swiper_main', {
      modules: [Pagination, Thumbs],
      pagination: {
        el: '.swiper-pagination',
        type: 'progressbar'
      },
      thumbs: {
        swiper: thumbSlider,
      },
    })
    const modalThumbSlider = new Swiper('.product-modal .swiper.swiper_thumb', {
      modules: [Navigation],
      slidesPerView: 5,
      freeMode: true,
      watchSlidesProgress: true,
      direction: 'vertical',
      slidesPerGroup: 5,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        1025: {
          spaceBetween: 1
        },
        1521: {
          spaceBetween: 10
        }
      }
    })
    const modalMainSlider = new Swiper('.product-modal .swiper.swiper_main', {
      modules: [Thumbs],
      direction: 'vertical',
      thumbs: {
        swiper: modalThumbSlider,
      },
      breakpoints: {
        320: {
          slidesPerView: 'auto',
        },
        1025: {
        },
        1521: {
          centeredSlides: true,
        }
      }
    })

    // product modal
    const modal = document.querySelector('.product-modal')
    const slides = document.querySelectorAll('.product-top__slider .swiper_main .swiper-slide')
    const modalClose = document.querySelector('.product-modal__close-image')
    const modalCloseContainer = document.querySelector('.product-modal__close')

    const toggleModal = () => {
        modal.classList.toggle('active')
        document.body.classList.toggle('body_fix')
    }

    modalMainSlider.on('slideNextTransitionStart', () => {
      if (window.innerWidth < 1025) {
        modalCloseContainer.classList.add('disabled')
      }
    })

    modalMainSlider.on('slidePrevTransitionStart', () => {
      if (modalCloseContainer.classList.contains('disabled')) {
        modalCloseContainer.classList.remove('disabled')
      }
    })

    slides.forEach(el => el.addEventListener('click', toggleModal))
    modalClose.addEventListener('click', toggleModal)
  }
})
