import Swiper, {Navigation} from 'swiper'

window.addEventListener('load', () => {
  new Swiper('.production__bottom .swiper', {
    modules: [Navigation],
    loop: true,
    navigation: {
      prevEl: '.swiper-button-prev',
      nextEl: '.swiper-button-next',
    },
    breakpoints: {
      320: {
        slidesPerView: 1.15,
        spaceBetween: 16,
        bloopAdditionalSlides: 9,
      },
      1025: {
        bloopAdditionalSlides: 9,
        slidesPerView: 1,
        spaceBetween: 20
      }
    }
  })
});
