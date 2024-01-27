import Swiper, {Navigation, Thumbs, Pagination} from 'swiper'

window.addEventListener('load', () => {
  if (!document.querySelector('.product-slider .main-slider')) {
    return false
  } else {
    const isLanding = document.querySelector('.main').classList.contains('main_landing')

    const thumbSlider = new Swiper('.product-slider .swiper.thumb-slider', {
      spaceBetween: isLanding ? 7 : 12,
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
          loop: false
        },
        1025: {
          slidesPerView: 1,
          loop: true
        }
      }
    })
  }

  // product modal
  const modal = document.querySelector('.product-slider__modal')
  const modalButtons = document.querySelectorAll('.swiper-modal-btn')
  const slides = document.querySelectorAll('.main-slider .swiper-slide')

  const showModal = (e) => {
    if (e.target.closest('.swiper-slide') && window.innerWidth > 1024 || e.target.closest('.swiper-modal-btn')) {
      modal.classList.add('active')
      document.body.classList.add('body_fix')
    }
  }

  const closeModal = (e) => {
    e.stopPropagation()
    if (e.target.closest('.product-slider__modal-close') || e.target.classList.contains('active')) {
      modal.classList.remove('active')
      document.body.classList.remove('body_fix')
    }
  }

  modalButtons.forEach(el => el.addEventListener('click', showModal))
  slides.forEach(el => el.addEventListener('click', showModal))
  modal.addEventListener('click', closeModal)
})
