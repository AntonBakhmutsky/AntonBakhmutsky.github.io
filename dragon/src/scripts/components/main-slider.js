import Swiper, {Navigation, Pagination, Autoplay} from 'swiper'

window.addEventListener('load', () => {
  if (!document.querySelector('.main-slider')) {
    return false
  } else {
    const slider = new Swiper('.main-slider .swiper',  {
      modules: [Autoplay, Navigation, Pagination],
      loop: true,
      slidesPerView: 1,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
      },
    })

    const sliderCounterLength = document.querySelector('.swiper-counter-length span')
    const sliderCounterProgress = document.querySelector('.swiper-counter-progress span')

    sliderCounterLength.textContent = slider.slides.length.toString()
    sliderCounterProgress.textContent = (slider.realIndex + 1).toString()

    slider.on('slideChange', () => {
      sliderCounterProgress.textContent = (slider.realIndex + 1).toString()
    })
  }
})
