import Swiper from 'swiper';
import {Navigation, Pagination} from 'swiper/modules';

let swiperInstance;

function initSwiper() {
  swiperInstance = new Swiper('.doctors-slider .swiper', {
    modules: [Navigation, Pagination],
    slidesPerView: 4,
    spaceBetween: 24,
    pagination: {
      el: '.swiper-pagination',
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    }
  });
}

function updateSwiper() {
  const screenWidth = window.innerWidth;

  if (screenWidth <= 576) {
    if (swiperInstance.params.slidesPerView !== 1) {
      swiperInstance.params.slidesPerView = 1;
      swiperInstance.params.spaceBetween = 20; // Можете установить spaceBetween в 0 или другое значение по вашему выбору.
      swiperInstance.update();
    }
  } else if (screenWidth <= 768) {
    if (swiperInstance.params.slidesPerView !== 3) {
      swiperInstance.params.slidesPerView = 3;
      swiperInstance.params.spaceBetween = 20;
      swiperInstance.update();
    }
  } else {
    if (swiperInstance.params.slidesPerView !== 4) {
      swiperInstance.params.slidesPerView = 4;
      swiperInstance.params.spaceBetween = 24;
      swiperInstance.update();
    }
  }
}

window.addEventListener('load', () => {
  initSwiper();
  updateSwiper();
});

window.addEventListener('resize', () => {
  updateSwiper();
});

