window.addEventListener('load', () => {
  if (!document.querySelector('.main_vacancies')) {
    return false
  } else {
    if (document.querySelector('.vacancies-offer__items')) {
      const container = document.querySelector('.vacancies-offer__items')

      function toggleAccordion(e) {
        if (e.target.closest('.accordion__visible')) {
          const acc = e.target.closest('.accordion')
          const accHidden = acc.querySelector('.accordion__hidden')
          acc.classList.toggle('open')
          accHidden.hasAttribute('style') ?
            accHidden.removeAttribute('style') :
            accHidden.style.maxHeight = `${accHidden.scrollHeight}px`
        }
      }

      container.addEventListener('click', toggleAccordion)
    }
  }
})
