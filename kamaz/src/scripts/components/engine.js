import lottieWeb from 'lottie-web';
import inViewport from '@/scripts/plugins/inViewport';
import anime from "animejs";

window.addEventListener('load', () => {

  if (!document.querySelector('.engine')) {
    return false;
  } else {

    // lottie animation
    const lottieContainer = document.querySelector('.engine__lottie');
    const animationData = require('@/assets/documents/R6-engine-animation_2.mp4.lottie-1.json');

    const animation = lottieWeb.loadAnimation({
      container: lottieContainer,
      animationData: animationData,
      renderer: 'svg',
      loop: false,
      autoplay: false
    });

    inViewport(lottieContainer, () => {
      animation.play();
    });

    // fields animation
    const inputFieldsContainer = document.querySelectorAll('.feedback__form-input');
  }
});
