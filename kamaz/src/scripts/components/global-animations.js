import inViewport from '@/scripts/plugins/inViewport';
import anime from 'animejs';

window.addEventListener('load', () => {

  // slide to right
  const slideToRightElements = document.querySelectorAll('.slide-right');

  slideToRightElements.forEach(el => {
    inViewport(el, () => {
      anime({
        targets: el,
        opacity: [0, 1],
        translateX: [-100, 0],
        duration: 1000,
        easing: 'easeOutQuart'
      })
    });
  });

  // slide to up
  const slideToUpElements = document.querySelectorAll('.slide-up');

  slideToUpElements.forEach(el => {
    inViewport(el, () => {
      anime({
        targets: el,
        opacity: [0, 1],
        translateY: [130, 0],
        duration: 1000,
        easing: 'easeOutQuart'
      })
    });
  });

  // slide to left
  const slideToLeftElements = document.querySelectorAll('.slide-left');

  slideToLeftElements.forEach(el => {
    inViewport(el, () => {
      anime({
        targets: el,
        opacity: [0, 1],
        translateX: [100, 0],
        duration: 1000,
        easing: 'easeOutQuart'
      })
    });
  });

  // nums animation
  if (!document.querySelector('.num-anim')) {
    return false;
  } else {

    const nums = document.querySelectorAll('.num-anim');

    nums.forEach(num => {
      const numValue = Number(num.textContent.split(' ').join(''));

      inViewport(num, () => {
        anime({
          targets: num,
          innerHTML: [0, numValue],
          easing: 'linear',
          round: 1
        });
      })
    });
  }
});
