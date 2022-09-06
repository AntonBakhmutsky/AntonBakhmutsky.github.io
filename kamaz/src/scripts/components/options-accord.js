window.addEventListener('load', () => {

  if (!document.querySelector('.options-accord')) {
    return false;
  } else {
    const accordions = document.querySelectorAll('.options-accord');

    const toggleAccordion = (e) => {
      const target = e.currentTarget;
      const hidden = target.querySelector('.options-accord__hidden');

      target.classList.toggle('active')
      !hidden.hasAttribute('style') ? hidden.setAttribute('style', `max-height: ${hidden.scrollHeight}px`) : hidden.removeAttribute('style');
    };

    accordions.forEach(el => el.addEventListener('click', toggleAccordion));
  }
});
