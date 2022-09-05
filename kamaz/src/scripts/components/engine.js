import lottieWeb from 'lottie-web';
import checkPosition from '@/scripts/plugins/chek-position';

window.addEventListener('load', () => {

  if (!document.querySelector('.engine')) {
    return false;
  } else {

    // lottie animation
    const lottieContainer = document.querySelector('.engine__lottie-container');
    const animationData = require('@/assets/documents/R6-engine-animation_2.mp4.lottie-1.json');
    let scrollPosition = 0, timer = null;

    const animation = lottieWeb.loadAnimation({
      container: lottieContainer,
      animationData: animationData,
      renderer: 'svg',
      loop: false,
      autoplay: false
    });

    window.addEventListener('scroll', () => {
      if (checkPosition(lottieContainer) && window.scrollY > scrollPosition) {
        scrollPosition = window.scrollY;
        animation.setSpeed(1);
        animation.play();
      } else if (checkPosition(lottieContainer) && window.scrollY < scrollPosition) {
        scrollPosition = window.scrollY;
        animation.setSpeed(-1);
        animation.play()
      } else {
        animation.stop();
      }
    });

    lottieContainer.addEventListener('click', () => {
      animation.setSpeed(-1)
      animation.play()
    })
  }
});
