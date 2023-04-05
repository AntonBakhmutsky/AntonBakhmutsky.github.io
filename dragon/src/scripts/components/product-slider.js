import Swiper, {Navigation, Thumbs, Pagination, FreeMode, EffectFade} from 'swiper'

window.addEventListener('load', () => {
  if (!document.querySelector('.product-top__slider')) {
    return false
  } else {
    let modalMainSlider
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
      modules: [Pagination, Thumbs, EffectFade],
      speed: 500,
      pagination: {
        el: '.swiper-pagination',
        type: 'progressbar'
      },
      effect: 'fade',
      fadeEffect: {
        crossFade: true
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
    if (window.innerWidth > 1024) {
      modalMainSlider = new Swiper('.product-modal .swiper.swiper_main', {
        modules: [Thumbs, FreeMode, EffectFade],
        speed: 500,
        effect: 'fade',
        fadeEffect: {
          crossFade: true
        },
        thumbs: {
          swiper: modalThumbSlider,
        },
        breakpoints: {
          1025: {
            spaceBetween: 10,
          },
          1521: {
            centeredSlides: true,
            spaceBetween: 10
          }
        }
      })
    } else {
      modalMainSlider = new Swiper('.product-modal .swiper.swiper_main', {
        modules: [Thumbs, FreeMode],
        direction: 'vertical',
        thumbs: {
          swiper: modalThumbSlider,
        },
        breakpoints: {
          320: {
            slidesPerView: 'auto',
            freeMode: {
              enabled: true,
              momentum: false
            },
          },
          1025: {
            freeMode: false,
            spaceBetween: 10,
          },
          1521: {
            centeredSlides: true,
            spaceBetween: 10
          }
        }
      })
    }

    // product modal
    const modal = document.querySelector('.product-modal')
    const slides = document.querySelectorAll('.product-top__slider .swiper_main .swiper-slide')
    const modalClose = document.querySelector('.product-modal__close-image')
    const modalCloseContainer = document.querySelector('.product-modal__close')

    const toggleModal = () => {
        modal.classList.toggle('active')
        document.body.classList.toggle('body_fix')
    }

    modalMainSlider.on('sliderMove', (s, e) => {
      if (window.innerWidth < 1025) {
        if (e.movementY > 0) {
          modalCloseContainer.classList.remove('disabled')
        } else {
          modalCloseContainer.classList.add('disabled')
        }
      }
    })

    slides.forEach(el => el.addEventListener('click', toggleModal))
    modalClose.addEventListener('click', toggleModal)
  }
})
