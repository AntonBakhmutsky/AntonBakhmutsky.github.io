import Swiper, {Autoplay, EffectFade} from 'swiper';

window.addEventListener('load', () => {

  Swiper.use([Autoplay, EffectFade])

  if (!document.querySelector('.top-slider')) {
    return false
  } else {
    const topSlider = new Swiper('.top-slider .swiper',  {
      autoplay: true,
      effect: "fade",
      speed: 5000
    })
  }

});
