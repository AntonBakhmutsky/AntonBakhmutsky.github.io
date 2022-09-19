import HvrSlider from '../plugins/hvr-slider';
import anime from 'animejs';
import togglePlaceholder from '@/scripts/plugins/input-placeholder';

window.addEventListener('load', () => {
  if (!document.querySelector('.working')) {
    return false;
  } else {

    // items accordion
    const workingItemsVisible = document.querySelectorAll('.working__item-visible');
    const workingItemsHidden = document.querySelectorAll('.working__item-hidden');

    const toggleHidden = (event) => {
      const target = event.currentTarget;
      const hidden = target.nextElementSibling;
      if (!target.classList.contains('active')) {
        workingItemsHidden.forEach(el => el.removeAttribute('style'));
        workingItemsVisible.forEach(el => el.classList.remove('active'));
      }
      target.classList.toggle('active');
      !hidden.hasAttribute('style') ? hidden.setAttribute('style', `max-height: ${hidden.scrollHeight}px`) : hidden.removeAttribute('style');
    }

    workingItemsVisible.forEach(el => el.addEventListener('click', toggleHidden));

    // image switcher(Hvr Slider)
    new HvrSlider('.working__item-images');

    // recalculation max height
    const recalculationMaxHeight = (e) => {
      const hiddenContent = e.currentTarget.closest('.working__item-hidden');
      hiddenContent.setAttribute('style', `max-height: ${hiddenContent.scrollHeight}px`);
    }

    // trade-in switcher
    const tradeInSwitcherButtons = document.querySelectorAll('.working__item-switch-btn');
    const tradeInSwitcherContentItems = document.querySelectorAll('.working__item-switch-content');

    const switchTradeInContent = (event) => {
      event.stopPropagation();
      const target = event.currentTarget;
      const eventId = target.dataset.id;
      const nextActiveContent = tradeInSwitcherContentItems[eventId];

      tradeInSwitcherButtons.forEach(el => el.classList.remove('active'));
      tradeInSwitcherContentItems.forEach(el => el.dataset.id === eventId ? el.classList.add('active') : el.classList.remove('active'));

      recalculationMaxHeight(event);

      anime({
        targets: nextActiveContent,
        opacity: [0, 1],
        translateY: [100, 0],
        duration: 800,
        easing: 'easeOutQuart'
      });

      target.classList.add('active');
    }

    tradeInSwitcherButtons.forEach(el => el.addEventListener('click', switchTradeInContent));

    // delivery steps
    const deliveryContentItems = document.querySelectorAll('.working__item-steps-content');
    const deliverySteps = document.querySelectorAll('.working__item-steps-num span');
    const deliveryNextButtons = document.querySelectorAll('.working__item-steps-btn.btn');
    const deliveryPreviousButtons = document.querySelectorAll('.working__item-steps-btn:not(.btn)');
    const deliveryInputs = document.querySelectorAll('.working__item-steps-input input');
    const deliveryTextarea = document.querySelectorAll('.working__item-steps-input textarea');

    const switchDeliveryContent = (event) => {
      event.stopPropagation();
      event.preventDefault();
      const target = event.currentTarget;
      const eventAction = target.dataset.action;
      const currentStepNum = document.querySelector('.working__item-steps-num span.active');
      const currentStepId = Number(currentStepNum.dataset.id);
      let nextStep, nextStepId, nextStepNums;

      if (eventAction === 'next' && currentStepId !== 2) {
        nextStepId = currentStepId + 1;
      } else if (eventAction === 'prev' && currentStepId !== 0) {
        nextStepId = currentStepId - 1;
      }

      if (nextStepId === 2) {
        deliveryNextButtons.forEach(el => el.removeEventListener('click', switchDeliveryContent));
      } else if (currentStepId === 2) {
        deliveryNextButtons.forEach(el => el.addEventListener('click', switchDeliveryContent));
      }

      nextStep = document.querySelector(`.working__item-steps-content[data-id="${nextStepId.toString()}"]`);
      nextStepNums = document.querySelectorAll(`.working__item-steps-num span[data-id="${nextStepId.toString()}"]`);

      deliveryInputs.forEach(el => el.removeAttribute('required'));
      deliveryTextarea.forEach(el => el.removeAttribute('required'));
      nextStep.querySelectorAll('input:not([type="radio"])').forEach(el => el.required = true);
      nextStep.querySelectorAll('textarea').forEach(el => el.required = true);
      deliveryContentItems.forEach(el => el.classList.remove('active'));
      deliverySteps.forEach(el => el.classList.remove('active'));
      nextStepNums.forEach(el => el.classList.add('active'));
      nextStep.classList.add('active');

      recalculationMaxHeight(event);

      anime({
        targets: nextStep,
        opacity: [0, 1],
        translateX: [-100, 0],
        duration: 800,
        easing: 'easeOutQuart'
      });

    }

    deliveryNextButtons.forEach(el =>el.addEventListener('click', switchDeliveryContent));
    deliveryPreviousButtons.forEach(el => el.addEventListener('click', switchDeliveryContent));

    // input placeholder
    const inputFields = document.querySelectorAll('.working__item-steps-input input');
    const textareaFields = document.querySelectorAll('.working__item-steps-input textarea');
    togglePlaceholder(inputFields);
    togglePlaceholder(textareaFields);

    // grow textarea
    textareaFields.forEach(el => {
      el.addEventListener('input', function (event) {
        const fieldContainer = this.closest('.form-input');
        fieldContainer.style.height = 0;
        fieldContainer.style.height = `${this.scrollHeight}px`;
        recalculationMaxHeight(event);
      });
    });
  }
});
