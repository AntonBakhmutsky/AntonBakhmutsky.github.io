import lottieWeb from 'lottie-web';
import inViewport from '@/scripts/plugins/inViewport';
import anime from "animejs";

window.addEventListener('load', () => {

  if (!document.querySelector('.feedback')) {
    return false;
  } else {

    // input placeholder
    const inputFields = document.querySelectorAll('.feedback__form-input input');

    const togglePlaceholder = (e) => {
      const inputValue = e.currentTarget.value.trim();
      const list = e.currentTarget.parentElement.querySelector('span').classList;

      !inputValue && list.contains('active') ? list.remove('active') : list.add('active');
    }

    inputFields.forEach(el => el.addEventListener('input', togglePlaceholder));

    // lottie animation
    const lottieContainer = document.querySelector('.feedback__form-lottie');
    const animationData = require('@/assets/documents/lf30_editor_gfccvbx0.json');

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

    inputFieldsContainer.forEach((el, i )=> {
      inViewport(el, () => {
        anime({
          targets: el,
          opacity: [0, 1],
          translateX: [-150, 0],
          duration: 1000,
          delay: i * 100,
          easing: 'easeOutQuart'
        })
      });
    });
  }
});
