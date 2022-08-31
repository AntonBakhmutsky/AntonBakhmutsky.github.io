import inViewport from '@/scripts/plugins/inViewport';
import anime from 'animejs';

window.addEventListener('load', () => {

  if (!document.querySelector('.trucks')) {
    return false;
  } else {

    const trucksImages = document.querySelectorAll('.trucks__item img');
    const trucksTitles = document.querySelectorAll('.trucks__item-title');

    trucksImages.forEach(image => {
      inViewport(image, () => {
        anime({
          targets: image,
          opacity: [0, 1],
          translateX: [-100, 0],
          duration: 1000,
          easing: 'easeOutQuart'
        })
      });
    })

    trucksTitles.forEach(title => {
      inViewport(title, () => {
        anime({
          targets: title,
          opacity: [0, 1],
          translateY: [100, 0],
          duration: 1000,
          easing: 'easeOutQuart'
        })
      });
    })
  }
});
