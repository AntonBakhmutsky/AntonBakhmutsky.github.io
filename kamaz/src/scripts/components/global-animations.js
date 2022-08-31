import inViewport from '@/scripts/plugins/inViewport';
import anime from 'animejs';

window.addEventListener('load', () => {

  const sectionTitle = document.querySelectorAll('.section-title');

  sectionTitle.forEach(title => {
    inViewport(title, () => {
      anime({
        targets: title,
        opacity: [0, 1],
        translateX: [-100, 0],
        duration: 1000,
        easing: 'easeOutQuart'
      })
    });
  });

});
