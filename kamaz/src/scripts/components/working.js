import HvrSlider from '../plugins/hvr-slider';
import anime from 'animejs';
import togglePlaceholder from '@/scripts/plugins/input-placeholder';

window.addEventListener('load', () => {
  if (!document.querySelector('.working')) {
    return false;
  } else {

    // input placeholder
    const inputFields = document.querySelectorAll('.working__item-steps-input input');
    togglePlaceholder(inputFields);

    // image switcher(Hvr Slider)
    new HvrSlider('.working__item-images');

    // trade-in switcher
    const tradeInSwitcherButtons = document.querySelectorAll('.working__item-switch-btn');
    const tradeInSwitcherContentItems = document.querySelectorAll('.working__item-switch-content');

    const switchContent = (event) => {
      const target = event.currentTarget;
      const eventId = target.dataset.id;
      const nextActiveContent = tradeInSwitcherContentItems[eventId];

      tradeInSwitcherButtons.forEach(el => el.classList.remove('active'));
      tradeInSwitcherContentItems.forEach(el => el.dataset.id === eventId ? el.classList.add('active') : el.classList.remove('active'));

      anime({
        targets: nextActiveContent,
        opacity: [0, 1],
        translateY: [100, 0],
        duration: 800,
        easing: 'easeOutQuart'
      });

      target.classList.add('active')
    }

    tradeInSwitcherButtons.forEach(el => el.addEventListener('click', switchContent));

    // delivery steps
  }
});
