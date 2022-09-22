window.addEventListener('load', () => {

  if (!document.querySelector('.options-accord')) {
    return false;
  } else {

    const toggleAccordion = (e) => {
      if (e.target.closest('.options-accord')) {
        const item = e.target.closest('.options-accord');
        const hidden = item.querySelector('.options-accord__hidden');

        item.classList.toggle('active')
        !hidden.hasAttribute('style') ? hidden.setAttribute('style', `max-height: ${hidden.scrollHeight}px`) : hidden.removeAttribute('style');
      }
    };

    document.addEventListener('click', toggleAccordion)
  }
});
