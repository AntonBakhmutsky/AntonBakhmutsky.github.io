import Splide from '@splidejs/splide'

function initSlider() {
  const thumbnailsSplide = new Splide('#splide-thumbnails', {
    rewind: true,
    fixedWidth: 52,
    fixedHeight: 52,
    isNavigation: true,
    arrows: true,
    gap: 9,
    focus: 'left',
    pagination: false,
    cover: true,
    breakpoints: {
      '375': {
        fixedWidth: 34,
        fixedHeight: 32,
        gap: 5
      }
    }
  }).mount();

  const primarySplide = new Splide('#splide-primary', {
    type: 'fade',
    heightRatio: 0.5,
    pagination: false,
    arrows: false,
    cover: true,
  });

  primarySplide.sync(thumbnailsSplide).mount();
}

window.addEventListener('load', () => {
  if (!document.querySelector('.splide')) {
    return false
  }

  initSlider()

  // fullscreen sliders
  const slides = document.querySelectorAll('.splide__slide-image')
  const slider = document.querySelector('.product__slider')
  const close = document.querySelector('.product__slider-close')

  const showFull = () => slider.classList.add('product__slider_full')
  const closeFull = () => {
    console.log('alert')
    slider.classList.remove('product__slider_full')
  }

  slides.forEach(el => el.addEventListener('click', showFull))
  close.addEventListener('click', closeFull)
})

document.addEventListener('DOMNodeInserted', (e) => {
  if (e.relatedNode.id === 'popup-window-content-basket-root_popup') {
    initSlider()
  }
})