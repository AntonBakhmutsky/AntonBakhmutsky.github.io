import Swiper, { Navigation } from 'swiper';
import HvrSlider from '../plugins/hvr-slider';

window.addEventListener('load', () => {

  Swiper.use([Navigation])

  if (!document.querySelector('.offers__slider')) {
    return false;
  } else {

    // card slider
    const popularSlider = new Swiper('.offers__slider.swiper',  {
      navigation: {
        nextEl: '.offers .swiper-button-next',
        prevEl: '.offers .swiper-button-prev'
      }
    });

    // image switcher(Hvr Slider)
    new HvrSlider('.offers__item-gallery');

    const offersSlidesItems = document.querySelectorAll('.offers__item');

    offersSlidesItems.forEach(el => {
      el.querySelectorAll('.hvr__dot').forEach(dot => {
        dot.addEventListener('click', () => {
          const index = Number(dot.dataset.id);
          const hvr = dot.closest('.hvr');

          hvr.querySelectorAll('.hvr__dot').forEach((dot, i) => {
            if (index === i) {
              dot.classList.add('hvr__dot--active');
            } else {
              dot.classList.remove('hvr__dot--active');
            }
          });

          hvr.querySelectorAll('img').forEach((img, i) => {
            if (index === i) {
              img.style.display = 'block';
            } else {
              img.style.display = 'none';
            }
          });
        });
      });
    });
  }
});
