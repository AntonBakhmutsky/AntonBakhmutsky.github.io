window.addEventListener('load', () => {

  if (!document.querySelector('.options-accord')) {
    return false;
  } else {
    const accordions = document.querySelectorAll('.options-accord');
    const accordionContainers = document.querySelectorAll('.options');

    const toggleAccordion = (e) => {
      const item = e.target.closest('.options-accord');
      const hidden = item.querySelector('.options-accord__hidden');

      item.classList.toggle('active')
      !hidden.hasAttribute('style') ? hidden.setAttribute('style', `max-height: ${hidden.scrollHeight}px`) : hidden.removeAttribute('style');
    };

    accordionContainers.forEach(el => el.addEventListener('click', toggleAccordion));

  }
});
