import Swiper, {Navigation} from 'swiper';

window.addEventListener('load', () => {
  const productionSlider = new Swiper('.production__slider.swiper', {
    modules: [Navigation],
    loop: true,
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 11
      },
      520: {
        slidesPerView: 1.5,
        spaceBetween: 15
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 15
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 15,
      },
      1224: {
        slidesPerView: 3.16,
        spaceBetween: 15
      }
    },
    navigation: {
      nextEl: '.swiper-button-next'
    }
  })
});
