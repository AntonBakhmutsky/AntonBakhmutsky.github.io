import HvrSlider from '../plugins/hvr-slider';

window.addEventListener('load', () => {


  if (!document.querySelector('.catalog__product')) {
    return false;
  } else {

    // image switcher(Hvr Slider)
    new HvrSlider('.catalog__product-images');

    document.querySelectorAll('.catalog__product .hvr').forEach(el => el.addEventListener('click', (e) => {
      e.stopPropagation();
      e.preventDefault();
    }));

  }
});
