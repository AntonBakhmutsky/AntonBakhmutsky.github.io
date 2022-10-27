import Swiper, {Navigation} from 'swiper';

window.addEventListener('load', () => {
  const productionSlider = new Swiper('.production__slider.swiper', {
    modules: [Navigation],
    slidesPerView: 3,
    spaceBetween: 15,
    loop: true
  })
});
