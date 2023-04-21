import Swiper, {Navigation, Pagination, Mousewheel, Autoplay} from 'swiper';


window.addEventListener('load', () => {
  if (!document.querySelector('.news-page__swiper-wrapper')) {
    return false
  } else {

    const swiper = new Swiper('.swiper-container', {
      modules: [Navigation, Pagination, Mousewheel, Autoplay],
      slidesPerView: 1,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      autoplay: {
        delay: 3000,
      },
    });


  }
})
