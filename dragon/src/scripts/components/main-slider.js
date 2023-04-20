import Swiper, {Navigation, Pagination, Autoplay} from 'swiper'

window.addEventListener('load', () => {
  if (!document.querySelector('.main-slider')) {
    return false
  } else {
    const slider = new Swiper('.main-slider .swiper:not(.swiper_mobile)',  {
      modules: [Autoplay, Navigation],
      loop: true,
      slidesPerView: 1,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      }
    })

    const sliderMobile = new Swiper('.main-slider .swiper_mobile',  {
      modules: [Pagination],
      loop: true,
      slidesPerView: 1,
      pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true
      }
    })

    const counter = document.querySelector('.swiper-counter')

    if (slider.slides.length > 1) {
      const sliderCounterLength = document.querySelector('.swiper-counter-length span')
      const sliderCounterProgress = document.querySelector('.swiper-counter-progress span')

      sliderCounterLength.textContent = slider.slides.length.toString()
      sliderCounterProgress.textContent = (slider.realIndex + 1).toString()

      slider.on('slideChange', () => {
        sliderCounterProgress.textContent = (slider.realIndex + 1).toString()
      })
    } else {
      counter.classList.add('disabled')
    }
  }
})
