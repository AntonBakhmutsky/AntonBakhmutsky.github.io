import Swiper, {Pagination, Thumbs} from 'swiper';

window.addEventListener('load', () => {

  Swiper.use([Pagination, Thumbs])

  if (!document.querySelector('.product-info')) {
    return false;
  } else {
    const swiperThumbs = new Swiper('.swiper.swiper__thumbs', {
      loop: true,
      spaceBetween: 10,
      slidesPerView: 4,
      freeMode: true,
      watchSlidesProgress: true,
    });
    const swiperMain = new Swiper('.swiper.swiper__main', {
      loop: true,
      spaceBetween: 10,
      pagination: {
        el: '.swiper-pagination',
        clickable: true
      },
      thumbs: {
        swiper: swiperThumbs,
      },
    });
  }

});
