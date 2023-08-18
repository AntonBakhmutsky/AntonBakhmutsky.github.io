import Swiper from 'swiper'
import {Navigation} from 'swiper/modules'



const screenWidth = window.innerWidth;

if (screenWidth <= 768) {
  const countCard = 3;
} else {
  const countCard = 4;
}

window.addEventListener('load', () => {
  new Swiper('.doctors-slider .swiper', {
    modules: [Navigation],
    slidesPerView: countCard,
    spaceBetween: 24,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    }

  })


})
