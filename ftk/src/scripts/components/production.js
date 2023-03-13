import Swiper, {Navigation} from 'swiper'

window.addEventListener('load', () => {
  new Swiper('.production__bottom .swiper', {
    modules: [Navigation],
    loop: true,
    initialSlide: 1,
    loopAdditionalSlides: 9,
    navigation: {
      nextEl: '.swiper-button-prev',
      prevEl: '.swiper-button-next',
    },
    breakpoints: {
      320: {
        slidesPerView: 1.01,
        spaceBetween: 10
      },
      1025: {
        slidesPerView: 1,
        spaceBetween: 20
      }
    }
  })
});
