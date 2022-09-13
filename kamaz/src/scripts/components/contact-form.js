import togglePlaceholder from '@/scripts/plugins/input-placeholder';

window.addEventListener('load', () => {

  if (!document.querySelector('.contact-form')) {
    return false;
  } else {

    // form inputs
    const contactForm = document.querySelector('.contact-form');
    const inputs = contactForm.querySelectorAll('.contact-form__input input');
    togglePlaceholder(inputs);

    // toggle form
    const contactFormBtn = document.querySelector('.contact-form-btn');
    const contactFormClose = contactForm.querySelector('.contact-form__close');

    const toggleContactForm = () => {
      contactForm.classList.toggle('active');
      contactFormBtn.classList.toggle('disabled');
      document.body.classList.toggle('body_fix');
    }

    contactFormBtn.addEventListener('click', toggleContactForm);
    contactFormClose.addEventListener('click', toggleContactForm);
  }

});
