import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';

let doctorsSlider;
let aboutSlider;

function initSwipers() {
  doctorsSlider = new Swiper('.doctors-slider .swiper', {
    modules: [Navigation, Pagination],
    slidesPerView: 4,
    spaceBetween: 24,
    pagination: {
      el: '.doctors-slider .swiper-pagination',
    },
    navigation: {
      nextEl: '.doctors-slider .swiper .swiper-button-next',
      prevEl: '.doctors-slider .swiper .swiper-button-prev',
    },
  });

  aboutSlider = new Swiper('.about-main-slider .swiper', {
    modules: [Navigation, Pagination],
    slidesPerView: 3,
    spaceBetween: 20,
    navigation: {
      nextEl: '.about-main-slider .swiper .swiper-button-next',
      prevEl: '.about-main-slider .swiper .swiper-button-prev',
    },
  });
}

function updateSwipers() {
  const screenWidth = window.innerWidth;

  if (screenWidth <= 576) {
    doctorsSlider.params.slidesPerView = 1;
    doctorsSlider.params.spaceBetween = 20;
    doctorsSlider.update();

    aboutSlider.params.slidesPerView = 1;
    aboutSlider.params.spaceBetween = 20;
    aboutSlider.update();
  } else if (screenWidth <= 768) {
    doctorsSlider.params.slidesPerView = 3;
    doctorsSlider.params.spaceBetween = 20;
    doctorsSlider.update();

    aboutSlider.params.slidesPerView = 3;
    aboutSlider.params.spaceBetween = 20;
    aboutSlider.update();
  } else {
    doctorsSlider.params.slidesPerView = 4;
    doctorsSlider.params.spaceBetween = 24;
    doctorsSlider.update();

    aboutSlider.params.slidesPerView = 4;
    aboutSlider.params.spaceBetween = 24;
    aboutSlider.update();
  }
}

window.addEventListener('DOMContentLoaded', () => {
  initSwipers();
  updateSwipers();
});

window.addEventListener('resize', () => {
  updateSwipers();
});


