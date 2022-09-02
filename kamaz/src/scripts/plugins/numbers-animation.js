import inViewport from '@/scripts/plugins/inViewport';
import anime from 'animejs';

export default function (nums) {
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
