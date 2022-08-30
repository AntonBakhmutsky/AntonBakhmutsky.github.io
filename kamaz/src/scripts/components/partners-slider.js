import Swiper from 'swiper';

window.addEventListener('load', () => {


  if (!document.querySelector('.partners__slider')) {
    return false
  } else {

    // partners slider
    const partnersSlider = new Swiper('.partners__slider.swiper',  {
      slidesPerView: "auto",
      breakpoints: {
        320: {
          spaceBetween: 10
        },
        1025: {
          spaceBetween: 0
        }
      }
    });

  }

});
